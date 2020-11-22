<?php

namespace App\Http\Controllers;

use App\Grid;
use Illuminate\Http\Request;

class GridController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Grid  $grid
     * @return \Illuminate\Http\Response
     */
    public function show(Grid $grid)
    {
        $grid->load('cells');   
        return view('show', compact('grid'));
    }
}
