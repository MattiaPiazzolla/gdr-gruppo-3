<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    if (($handle = fopen(storage_path('app/csv/types.csv'), 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            DB::table('types')->insert([
                'name' => $data[0],
                'image' => $data[1],
                'description' => $data[2],
            ]);
        }
        fclose($handle);
    }
}
}