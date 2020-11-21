<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    public function grid()
    {
        return $this->belongsTo(Grid::class);
    }
}
