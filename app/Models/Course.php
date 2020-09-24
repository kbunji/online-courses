<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'category_course');
    }
}
