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
            // Variabile di controllo per saltare la prima riga
            $firstRow = true;

            // Leggi tutte le righe del file CSV
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // Salta la prima riga
                if ($firstRow) {
                    $firstRow = false;
                    continue; // Passa alla prossima iterazione del ciclo
                }

                // Inserisci i dati nel database
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