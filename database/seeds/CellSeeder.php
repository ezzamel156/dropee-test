<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gridId = DB::table('grids')->first('id')->id;
        $currentTimestamp = Carbon::now()->format('Y-m-d H:i:s');
        $cells = [
            ['content'=> 'Dropee.com', 'index' => 2, 'grid_id' => $gridId, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['content'=> 'Build Trust', 'index' => 4, 'grid_id' => $gridId, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['content'=> 'SaaS enabled marketplace', 'index' => 7, 'grid_id' => $gridId, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['content'=> 'B2B Marketplace', 'index' => 9, 'grid_id' => $gridId, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['content'=> 'Provide Transparency', 'index' => 16, 'grid_id' => $gridId, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp]
        ];
        
        DB::table('cells')->insert($cells);
    }
}
