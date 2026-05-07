<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable = [];

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
