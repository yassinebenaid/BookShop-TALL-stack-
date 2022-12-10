<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ShowHomePageController extends Controller
{

    public function __invoke(Category $category)
    {

        if ($category->exists) return  view("home.index-2");

        return view("home.index");
    }
}
