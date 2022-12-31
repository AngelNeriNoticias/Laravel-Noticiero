<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index($id){
        $subCategory = SubCategory::find($id);
        $posts = Post::with('author')->where('sub_category_id', $id)->orderBy('created_at', 'desc')->paginate(8);
        return view('frontend.sub-category', compact('posts', 'subCategory'));
    }
}
