<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public static function createCategory($title, $titleMeta, $parent_id = 0)
    {
        $category = new Category();
        $category->title = $title;
        $category->title_meta = $titleMeta;
        $category->parent_id = $parent_id;
        return $category->save();
    }

    public static function editCategory($title, $titleMeta, $parent_id) {
        $category = new Category();
        $category->title = $title;
        $category->title_meta = $titleMeta;
        $category->parent_id = $parent_id;
        return $category->save();
    }

    public function courses() {
        return $this->belongsToMany('App\Models\Course', 'category_course');
    }
}
