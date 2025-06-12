<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['user_id', 'exercise_id', 'result'];

    public function exercise()
    {
        return $this->belongsTo(\App\Models\Exercise::class);
    }

}
