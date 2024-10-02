<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    if (($handle = fopen(storage_path('app/csv/items.csv'), 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            DB::table('items')->insert([
                'name' => $data[0],
                'slug' => $data[1],
                'type' => $data[2],
                'category' => $data[3],
                'weight' => $data[4],
                'cost' => $data[5],
                'dice' => $data[6],
            ]);
        }
        fclose($handle);
    }
}
}