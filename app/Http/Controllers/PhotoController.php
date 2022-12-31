<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('updated_at', 'desc')->paginate(8);
        return view('frontend.photo-gallery', compact('photos'));
    }
}
