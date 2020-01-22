@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? "Edit Post" : "Create Post" }}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ isset($post) ? route('post.update', $post->id) : route('post.store') }}" method="POST" enctype="multipart/form-data">
                @if(isset($post))
                    @method("PUT")
                @endif
                @csrf
                <div class="form-group">
                    <label for="title" hidden>Title</label>
                    <input class="form-control" name="title" type="text" value="{{ isset($post) ? "$post->title" : "" }}" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="description" hidden>Description</label>
                    <textarea class="form-control" name="description" placeholder="Description" rows="5">{{ isset($post) ? "$post->description" : "" }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content" hidden>Content</label>
                    <textarea class="form-control" name="content" placeholder="Content" rows="10">{{ isset($post) ? "$post->content" : "" }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category" hidden>Category</label>
                    <select class="form-control" name="category">
                        <option>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(isset($post)) {{ $category->id == $post->category_id ? "selected" : "" }} @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">Select Tags</label>
                        <select name="tags[]" id="tags" class="form-control" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" 
                                    @isset($post)
                                        {{ $post->hasTags($tag->id) ? "selected" : "" }}    
                                    @endisset
                                    >{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="published_at" hidden>Published At</label>
                    <input class="form-control" name="published_at" type="text" placeholder="Published At">
                </div>
                    @if(isset($post))
                        <div class="form-group">
                            <img class="img-thumbnail" src="{{ asset('storage/' . $post->image) }}">
                        </div>
                    @endif
                <div class="form-group">
                    <label for="image">Upload an image</label>
                    <input class="form-control" name="image" type="file">
                </div>
                <div>
                    <button type="submit" class="btn btn-success">{{ isset($post) ? "Edit Post" : "Create Post" }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
