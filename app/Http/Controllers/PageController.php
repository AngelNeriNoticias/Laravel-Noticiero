<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Page;
use App\Constants\PagesConstant;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::where('page_id', PagesConstant::$aboutUs)->first();
        return view('frontend.about', compact('page'));
    }

    public function terms(){
        $page = Page::where('page_id', PagesConstant::$termsAndConditions)->first();
        return view('frontend.terms', compact('page'));
    }

    public function privacy(){
        $page = Page::where('page_id', PagesConstant::$privacyPolicy)->first();
        return view('frontend.privacy', compact('page'));
    }

    public function disclaimer(){
        $page = Page::where('page_id', PagesConstant::$disclaimer)->first();
        return view('frontend.disclaimer', compact('page'));
    }

    public function faq(){
        $questions = Faq::all();
        return view('frontend.faq', compact('questions'));
    }

    public function contact(){
        return view('frontend.contact');
    }
}
