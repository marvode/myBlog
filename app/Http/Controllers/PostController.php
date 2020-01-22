<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Post;
use App\Category;
use App\Tags;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')->with('categories', Category::all())->with('tags', Tags::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image = $request->image->store('post');
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category,
            'published_at' => $request->published_at,
            'user_id' => auth()->user()->id,
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post uploaded successfully');

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tags::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content']);
        if($request->hasFile('image')) {
            $image = $request->image->store('post');
            $post->deleteImage();

            $data['image'] = $image;
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success', 'Post updated successfully');

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Post deleted successfully');
        }
        else {
            $post->delete();
            session()->flash('success', 'Post trashed successfully');
        }
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed() {
        $trashed = Post::onlyTrashed()->get();
        return view('post.index')->withPosts($trashed);
    }

    public function restore($id) {
        $post = Post::onlyTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        session()->flash('success', 'Post restored successfully');

        return redirect(route('post.index'));
    }
}
