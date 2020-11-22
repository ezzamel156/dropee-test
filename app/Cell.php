<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    public function grid()
    {
        return $this->belongsTo(Grid::class);
    }

    public function swapIndex($targetCell)
    {   
        $this->index = $targetCell->index;
        $targetCell->index = $this->getOriginal('index');
        $this->save();
        $targetCell->save();
        return $this;
    }
}
