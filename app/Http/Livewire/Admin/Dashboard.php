<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $mostViewedPost;
    public $mostViewedPostThisMonth;
    public $totalPostsPublishedThisMonth;
    public $totalViewsThisMonth;
    public $totalViews;
    public $totalUsers;
    public $totalPosts;
    public $mostViewedSubCategory;

    public function render()
    {
        return view('livewire.admin.dashboard');
    }

    public function mount(){
        $this->mostViewedPost = Post::orderBy('visitors', 'desc')->first();
        $this->mostViewedPostThisMonth = Post::whereMonth('created_at', now()->month)->orderBy('visitors', 'desc')->first();
        $this->totalPostsPublishedThisMonth = Post::whereMonth('created_at', now()->month)->count();
        $this->totalViewsThisMonth = Post::whereMonth('created_at', now()->month)->get()->sum('visitors');
        $this->totalPosts = Post::count();
        $this->totalUsers = User::count();
        $this->totalViews = Post::get()->sum('visitors');
        $this->mostViewedSubCategory = Post::with('subCategory')->orderBy('visitors', 'desc')->first();
        
    }
}
