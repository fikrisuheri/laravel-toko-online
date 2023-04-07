<?php

use Illuminate\Database\Seeder;
use App\Rekening;
class RekeningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['bank_name' => 'BCA','atas_nama'=>'AL AMRIKASIR','no_rekening'=>'0322309901']
        ];
        Rekening::insert($data);
    }
}
