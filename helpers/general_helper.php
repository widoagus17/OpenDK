<?php

/*
 * File ini bagian dari:
 *
 * OpenDK
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2017 - 2022 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package    OpenDK
 * @author     Tim Pengembang OpenDesa
 * @copyright  Hak Cipta 2017 - 2022 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license    http://www.gnu.org/licenses/gpl.html    GPL V3
 * @link       https://github.com/OpenSID/opendk
 */

use App\Models\Menu;
use App\Models\Role;
use App\Models\DataDesa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

/**
 * Parsing url image dari rss feed description
 *
 * @param string $content
 * @return string
 */
if (!function_exists('get_tag_image')) {
    function get_tag_image(string $content)
    {
        if (preg_match('/<img.+?src="(.+?)"/', $content, $match)) {
            return $match[1];
        }

        return asset('img/no-image.png');
    }
}

/**
 * { function_description }
 *
 * @param      <type>  $parent_id  The parent identifier
 *
 * @return     <type>  ( description_of_the_return_value )
 */
function define_child($parent_id)
{
    $child = Menu::Where('parent_id', $parent_id)->where('is_active', true)->get();
    return $child;
}

/**
 * { function_description }
 *
 * @param      <type>  $id          The identifier
 * @param      <type>  $permission  The permission
 *
 * @return     <type>  ( description_of_the_return_value )
 */
function permission_val($id, $permission)
{
    $role = Role::findOrFail($id);
    $format = json_decode(json_encode($role), true);
    $result = (isset($format['permissions'][$permission]) && $format['permissions'][$permission] != '' ? 1 : 0);
    return $result;
}

/**
 * Uploads an image.
 *
 * @param      <type>  $image  The image
 * @param      string $file The file
 *
 * @return     string  ( description_of_the_return_value )
 */
function upload_image($image, $file)
{
    $extension = $image->getClientOriginalExtension();
    $path = public_path('uploads/' . $file . '/');
    if (!file_exists($path)) {
        File::makeDirectory($path, 0777, true);
    }

    $name = time() . uniqid();
    $img = Image::make($image->getRealPath());
    $img->save($path . $name . '.' . $extension);
    return $name . '.' . $extension;
}

/**
 * Generate Password
 *
 * @param      integer $length Length Character
 *
 * @return     string   voucher
 */
function generate_password($length = 6)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $number = '0123456789';
    $charactersLength = strlen($characters);
    $numberLength = strlen($number);
    $randomString = '';
    for ($i = 0; $i < 3; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    for ($i = 0; $i < 3; $i++) {
        $randomString .= $number[rand(0, $numberLength - 1)];
    }
    $randomString = str_shuffle($randomString);
    return $randomString;
}

/**
 * Respon Meta
 *
 * @param      <type>  $message  The message
 */
function respon_meta($code, $message)
{
    $meta = [
        'code' => $code,
        'message' => $message,
    ];
    return $meta;
}

function convert_xml_to_array($filename)
{
    try {
        $xml = file_get_contents($filename);
        $convert = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($convert);
        $array = json_decode($json, true);
        return $array;
    } catch (\Exception $e) {
        \Log::info([
            "ERROR MESSAGE" => $e->getMessage(),
            "LINE" => $e->getLine(),
            "FILE" => $e->getFile(),
        ]);
        return false;
        // throw new \UnexpectedValueException(trans('message.news.import-error'), 1);
    }
}

function convert_born_date_to_age($date)
{
    $from = new DateTime($date);
    $to = new DateTime('today');
    return $from->diff($to)->y;
}

function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return random_color_part() . random_color_part() . random_color_part();
}

function years_list()
{
    // Create Year List for 4 years ago
    $this_year = date('Y');
    $year_list = [];

    for ($i = 1; $i <= 3; $i++) {
        $year_list[] = (int) $this_year--;
    }

    return $year_list;
}

function months_list()
{
    return [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];
}

function get_words($sentence, $count = 10)
{
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

function diff_for_humans($date)
{
    Carbon::setLocale('id');
    return Carbon::parse($date)->diffForHumans();
}

function format_date($date)
{
    Carbon::setLocale('id');
    return Carbon::parse($date)->toDayDateTimeString();
}

function kuartal_bulan()
{
    return [
        'q1' => [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
        ],
        'q2' => [
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
        ],
        'q3' => [
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
        ],
        'q4' => [
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ],
    ];
}

function semester()
{
    return [
        1 => [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
        ],
        2 => [
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ],
    ];
}

function status_rekam()
{
    return [
        1 => 'BELUM WAJIB',
        2 => 'BELUM REKAM',
        3 => 'SUDAH REKAM',
        4 => 'CARD PRINTED',
        5 => 'PRINT READY RECORD',
        6 => 'CARD SHIPPED',
        7 => 'SENT FOR CARD PRINTING',
        8 => 'CARD ISSUED',
    ];
}

function is_wajib_ktp($umur, $status_kawin)
{
    // Wajib KTP = sudah umur 17 atau pernah kawin
    if ($umur === null) {
        return null;
    }
    $wajib_ktp = (($umur > 16) or (!empty($status_kawin) and $status_kawin != 1));
    return $wajib_ktp;
}

function is_img($url = null, $img = '/img/no-image.png')
{
    return asset($url != null && file_exists(public_path($url)) ? $url : $img);
}

function is_logo($url = '', $file = '/img/logo.png')
{
    return is_img($url, $file);
}

function is_user($url = null, $sex = 1)
{
    if ($url) {
        $url = 'storage/penduduk/foto/' . $url;
    }

    $default = 'img/pengguna/' . (($sex == 2) ? 'wuser.png' : 'kuser.png');

    return is_img($url, $default);
}

if (!function_exists('divnum')) {
    function divnum($numerator, $denominator)
    {
        return $denominator == 0 ? 0 : ($numerator / $denominator);
    }
}
function terbilang($angka)
{
    $angka = abs($angka);
    $baca = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];

    $terbilang = "";
    if ($angka < 12) {
        $terbilang = " " . $baca[$angka];
    } elseif ($angka < 20) {
        $terbilang = terbilang($angka - 10) . " Belas";
    } elseif ($angka < 100) {
        $terbilang = terbilang($angka / 10) . " Puluh" . terbilang($angka % 10);
    } elseif ($angka < 200) {
        $terbilang = " seratus" . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        $terbilang = terbilang($angka / 100) . " Ratus" . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        $terbilang = " seribu" . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        $terbilang = terbilang($angka / 1000) . " Ribu" . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        $terbilang = terbilang($angka / 1000000) . " Juta" . terbilang($angka % 1000000);
    }

    return $terbilang;
}

function qrcode_generate($pathqr, $namaqr, $isiqr, $logoqr, $sizeqr, $foreqr)
{
    $barcode = new TCPDF2DBarcode($isiqr, 'QRCODE,H');

    if (! empty($foreqr)) {
        if ($foreqr[0] == '#') {
            $foreqr = substr($foreqr, 1);
        }
        $split = str_split($foreqr, 2);
        $r     = hexdec($split[0]);
        $g     = hexdec($split[1]);
        $b     = hexdec($split[2]);
    }

    if (!File::exists($pathqr)) {
        File::makeDirectory($pathqr, 0755, true, true);
    }

    //Hasilkan QRCode
    $imgData  = $barcode->getBarcodePngData($sizeqr, $sizeqr, [$r, $g, $b]);
    $filename = $pathqr . $namaqr . '.png';
    file_put_contents($filename, $imgData);

    //Ubah backround transparan ke warna putih supaya terbaca qrcode scanner
    $src_qr    = imagecreatefrompng($filename);
    $sizeqrx   = imagesx($src_qr);
    $sizeqry   = imagesy($src_qr);
    $backcol   = imagecreatetruecolor($sizeqrx, $sizeqry);
    $newwidth  = $sizeqrx;
    $newheight = ($sizeqry / $sizeqrx) * $newwidth;
    $color     = imagecolorallocatealpha($backcol, 255, 255, 255, 1);
    imagefill($backcol, 0, 0, $color);
    imagecopyresampled($backcol, $src_qr, 0, 0, 0, 0, $newwidth, $newheight, $sizeqrx, $sizeqry);
    imagepng($backcol, $filename);
    imagedestroy($src_qr);
    imagedestroy($backcol);

    //Tambah Logo
    $logopath = $logoqr; // Logo yg tampil di tengah QRCode
    $QR       = imagecreatefrompng($filename);
    $logo     = imagecreatefromstring(file_get_contents($logopath));
    imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
    imagealphablending($logo, false);
    imagesavealpha($logo, true);
    $QR_width       = imagesx($QR);
    $QR_height      = imagesy($QR);
    $logo_width     = imagesx($logo);
    $logo_height    = imagesy($logo);
    $logo_qr_width  = $QR_width / 4;
    $scale          = $logo_width / $logo_qr_width;
    $logo_qr_height = $logo_height / $scale;
    imagecopyresampled($QR, $logo, $QR_width / 2.5, $QR_height / 2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    imagepng($QR, $filename);
    imagedestroy($QR);
    return $filename;
}

/**
 * Parsing url image dari rss feed description
 *
 * @param string $kodedesa
 * @return mixed
 */
if (!function_exists('verif_desa')) {
    function verif_desa(string $kodedesa)
    {
        $desa = DataDesa::where('desa_id', $kodedesa)->first();
        if ($desa == null) {
            return false;
        }
        return $desa;
    }
}
