<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tags;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        if ($search = request()->query('search')) {
            $posts = Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(2);
        }
        else {
            $posts = Post::simplePaginate(2);
        }

        $topPosts = Post::orderBy('views', 'desc')->take(5)->get();
        
        return view('welcome')
        ->with('categories', Category::all())
        ->with('posts', $posts)
        ->with('tags', Tags::all())
        ->with('topPosts', $topPosts);
    }
}
