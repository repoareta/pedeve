<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class GcgJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert data ke table gcg_jabatan
        DB::table('gcg_jabatan')->insert([
            'nama' => 'Direktur',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('gcg_jabatan')->insert([
            'nama' => 'Manajer/Setara',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('gcg_jabatan')->insert([
            'nama' => 'Staff',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
