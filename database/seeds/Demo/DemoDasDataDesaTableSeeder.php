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

namespace Database\Seeds\Demo;

use App\Models\Profil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDasDataDesaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profil = Profil::first();

        DB::table('das_data_desa')->truncate();

        DB::table('das_data_desa')->insert([
            0 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2001',
                'nama' => 'Bedalewun',
                'website' => 'https://bana.opendesa.id/',
            ],
            1 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2002',
                'nama' => 'Lebanuba',
                'website' => 'https://natairaya.com/',
            ],
            2 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2003',
                'nama' => 'Rianwale',
                'website' => 'https://bantal.desa.id/',
            ],
            3 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2004',
                'nama' => 'Bungalawan',
                'website' => 'https://berputar.opensid.or.id/',
            ],
            4 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2005',
                'nama' => 'Lamawolo',
                'website' => '',
            ],
            5 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2006',
                'nama' => 'Helanlangowuyo',
                'website' => '',
            ],
            6 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2007',
                'nama' => 'Lewopao',
                'website' => '',
            ],
            7 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2008',
                'nama' => 'Nelereren',
                'website' => '',
            ],
            8 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2009',
                'nama' => 'Boleng',
                'website' => '',
            ],
            9 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2010',
                'nama' => 'Neleblolong',
                'website' => '',
            ],
            10 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2011',
                'nama' => 'Duablolong',
                'website' => '',
            ],
            11 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2012',
                'nama' => 'Lewokeleng',
                'website' => '',
            ],
            12 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2013',
                'nama' => 'Nelelamawangi',
                'website' => '',
            ],
            13 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2014',
                'nama' => 'Harubala',
                'website' => '',
            ],
            14 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2015',
                'nama' => 'Nelelamadike',
                'website' => '',
            ],
            15 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2016',
                'nama' => 'Lamabayung',
                'website' => '',
            ],
            16 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2017',
                'nama' => 'Lewat',
                'website' => '',
            ],
            17 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2018',
                'nama' => 'Dokeng',
                'website' => '',
            ],
            18 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2019',
                'nama' => 'Bayuntaa',
                'website' => '',
            ],
            19 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2020',
                'nama' => 'Nobo',
                'website' => '',
            ],
            20 => [
                'profil_id' => $profil->id,
                'desa_id' => $profil->kecamatan_id . '.2021',
                'nama' => 'Nelelamawangi Dua',
                'website' => '',
            ],
        ]);
    }
}
