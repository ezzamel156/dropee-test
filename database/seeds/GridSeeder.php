<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTimestamp = Carbon::now()->format('Y-m-d H:i:s');
        DB::table('grids')->insert([
            'name' => 'Dropee Grid',
            'columnCount' => 4,
            'rowCount' => 4,
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp
        ]);
    }
}
