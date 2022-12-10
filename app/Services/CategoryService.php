<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllcategories()
    {
        return Category::get(["name"]);
    }

    public function applyWithCount(string $categoryName)
    {
        return Category::whereName($categoryName)->select("name")->withCount("books")->first("name");
    }

    public static function instance()
    {
        return new static;
    }
}
