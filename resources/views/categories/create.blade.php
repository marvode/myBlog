@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ isset($category) ? "Edit Category" : "Create Category" }}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
                @csrf
                @if(isset($category))
                    @method("PUT")
                @endif
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ isset($category) ? $category->name : "" }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-success">{{ isset($category) ? 'Update Category' : 'Add Category' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection