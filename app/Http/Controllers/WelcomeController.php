<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tags;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $topPosts = Post::orderBy('views', 'desc')->searched()->take(5)->get();
        
        return view('welcome')
        ->with('categories', Category::all())
        ->with('posts', Post::searched()->simplePaginate(2))
        ->with('tags', Tags::all())
        ->with('topPosts', $topPosts);
    }
}
