<?php

use App\Grid;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $grid = Grid::with('cells')->first();
    return redirect()->route('grid', [$grid]);
    // return view('show', compact('grid'));
});

Route::get('/grids/{grid}', 'GridController@show')->name('grid');

Route::put('/grids/{grid}/cells/{cell}/index', 'CellController@indexUpdate');
Route::put('/grids/{grid}/cells/{cell}', 'CellController@update');
Route::post('/grids/{grid}/cells', 'CellController@store');
