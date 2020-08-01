<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class GcgFungsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gcg_fungsi')->insert([
            'nama' => 'Direktur',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('gcg_fungsi')->insert([
            'nama' => 'CSBS',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('gcg_fungsi')->insert([
            'nama' => 'IARM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('gcg_fungsi')->insert([
            'nama' => 'FINANCE',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
