<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Grid;
use Illuminate\Http\Request;

class CellController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Grid $grid)
    {
        $cell = new Cell;
        $cell->content = strip_tags($request->content,'<p><strong><em><s><u><br>');
        $cell->index = $request->cellIndex;
        $grid->cells()->save($cell);
        return response()->json($cell);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grid  $grid
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grid $grid, Cell $cell)
    {        
        $cell->content = strip_tags($request->content,'<p><strong><em><s><u><br>');
        $cell->save();
        return response()->json($cell);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grid  $grid
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function indexUpdate(Request $request, Grid $grid, Cell $cell)
    {
        if($request->has('swappedCellId')) {
            $targetCell = Cell::findOrFail($request->swappedCellId);
            $cell->swapIndex($targetCell);
        }
        else {
            $cell->index = $request->cellIndex;
            $cell->save();
        }
        return response()->json($cell);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cell $cell)
    {
        //
    }
}
