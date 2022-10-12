<?php

use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Province;
use App\City;
class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        printf("Mengambil data Provinsi dari Raja Ongkir\n");
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow) {
            Province::create([
                'province_id' => $provinceRow['province_id'],
                'title' => $provinceRow['province']
            ]);

            printf("Mengambil data kota berdasarkan provinsi: %s\n", $provinceRow['province']);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
            foreach ($daftarKota as $cityRow) {
                City::create([
                    'province_id' => $provinceRow['province_id'],
                    'city_id' => $cityRow['city_id'],
                    'title' => $cityRow['city_name']
                ]);
            }
        }
    }
}
