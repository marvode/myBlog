@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection

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
                    <label for="content">Content</label>
                    <input type="hidden" name="content" id="content" value="{!! isset($post) ? "$post->content" : "" !!}">
                    <trix-editor input="content"></trix-editor>
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
                        <select name="tags[]" id="tags_selector" class="form-control" multiple>
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
                    <input class="form-control" name="published_at" id="published_at" type="text" placeholder="Published At" value="{{ isset($post) ? "$post->published_at" : now() }}">
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true,
        });

        $(document).ready(function() {
            $('#tags_selector').select2();
        });
    </script>
@endsection