<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;

class ShowController extends Controller
{
    public function index()
    {
        $advices = Show::orderBy('updated_at', 'desc')->paginate(8);
        return view('frontend.show-gallery', compact('advices'));
    }
}
