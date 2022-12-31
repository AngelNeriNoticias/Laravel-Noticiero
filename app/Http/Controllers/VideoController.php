<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('updated_at', 'desc')->paginate(8);
        return view('frontend.video-gallery', compact('videos'));
    }
}
