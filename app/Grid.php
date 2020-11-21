<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grid extends Model
{
    public function getSizeAttribute()
    {
        return $this->columnCount * $this->rowCount;
    }

    public function cells()
    {
        return $this->hasMany(Cell::class);
    }

    public function getLayoutAttribute()
    {
        $layout = collect()->pad($this->size, null);
        foreach ($this->cells as $cell) {
            $layout->put($cell->index-1, $cell);
        }
        return $layout;
    }
}
