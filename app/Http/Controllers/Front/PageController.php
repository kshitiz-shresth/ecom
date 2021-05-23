<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showCategory($category_slug){
        return Category::where('slug',$category_slug)->first() ?? abort('404');
    }
    public function showSubCategory($category_slug,$sub_category_slug){
        $category = Category::where('slug',$category_slug)->first();
        return $category->sub_categories->where('slug',$sub_category_slug)->first() ?? abort('404') ;
    }
    public function showSubSubCategory($category_slug,$sub_category_slug,$sub_sub_category_slug){
        $category = Category::where('slug',$category_slug)->first() ?? abort('404');
        $sub_category = $category->sub_categories->where('slug',$sub_category_slug)->first() ?? abort('404');
        return $sub_category->sub_sub_categories->where('slug',$sub_sub_category_slug)->first() ?? abort('404');
    }
}
