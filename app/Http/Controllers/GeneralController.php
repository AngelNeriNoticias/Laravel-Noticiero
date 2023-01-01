<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Video;
use App\Models\Ticker;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class GeneralController extends Controller
{
    public function index()
    {
        App::setLocale('es');
        $data['featuredPosts'] = Post::with('author')->orderBy('id', 'desc')->limit(10)->get();

        $data['tickers'] = Ticker::where('show', true)->orderBy('order', 'asc')->get();
        $data['subcategories'] = SubCategory::orderBy('order', 'asc')
            ->where([
                ['show_menu', true],
                ['show', true]
                ])
            ->with('posts')
            ->limit(4)
            ->get();

        $data['videos'] = Video::orderBy('id', 'desc')->limit(5)->get();
        return view('frontend.index', $data);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect()->route('login');
    }
}
