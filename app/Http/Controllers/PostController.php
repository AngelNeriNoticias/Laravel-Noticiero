<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\TagPost;

class PostController extends Controller
{
    public function detail($id)
    {
        $post = Post::with('author')->find($id);
        $post->visitors = $post->visitors + 1;
        $post->update();

        $postsRelated = Post::orderBy('id', 'desc')
            ->where('sub_category_id', $post->sub_category_id)
            ->limit(3)->get();

        $tags = TagPost::with('tag')->where('post_id', $id)->get();

        return view('frontend.post-detail', compact('post', 'tags', 'postsRelated'));
    }

    public function author($id)
    {
        $posts = Post::with('author')->where('user_id', $id)->orderBy('created_at', 'desc')->paginate(8);

        return view('frontend.post-author', compact('posts'));
    }

    public function tag($id){
        $tag = Tag::find($id);
        $posts = TagPost::with('post')->where('tag_id', $id)->orderBy('created_at', 'desc')->paginate(8);

        return view('frontend.post-tag', compact('posts', 'tag'));
    }

    public function date($date){
        $posts = Post::with('author')->where('created_at', 'like', $date.'%')->orderBy('created_at', 'desc')->paginate(8);

        return view('frontend.post-date', compact('posts'));
        
    }
}
