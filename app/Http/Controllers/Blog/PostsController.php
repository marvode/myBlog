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
        return view('tag')->with('tag', $tag)->with('posts', $tag->posts()->simplePaginate(2))->with('categories', Category::all())->with('tags', Tags::all());
    }

    public function category(Category $category)
    {
        return view('category')->with('category', $category)->with('posts', $category->posts()->simplePaginate(2))->with('categories', Category::all())->with('tags', Tags::all());
    }
}
