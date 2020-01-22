<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tags;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {   
        if (auth()->user()->id != $post->user_id) {
            $post->increment('views');
        }
        
        return view('blog.show')->with('post', $post);
    }

    public function tag(Tags $tag)
    {
        $topPosts = Post::orderBy('views', 'desc')->searched()->take(5)->get();

        return view('tag')
        ->with('tag', $tag)
        ->with('posts', $tag->posts()->searched()->simplePaginate(2))
        ->with('categories', Category::all())
        ->with('tags', Tags::all())
        ->with('topPosts', $topPosts);
    }

    public function category(Category $category)
    {
        $topPosts = Post::orderBy('views', 'desc')->searched()->take(5)->get();

        return view('category')
            ->with('category', $category)
            ->with('posts', $category->posts()->searched()->simplePaginate(2))
            ->with('categories', Category::all())
            ->with('tags', Tags::all())
            ->with('topPosts', $topPosts);
    }
}
