@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ isset($tag) ? "Edit Tags" : "Create Tags" }}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form method="POST" action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}">
                @csrf
                @if(isset($tag))
                    @method("PUT")
                @endif
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ isset($tag) ? $tag->name : "" }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-success">{{ isset($tag) ? 'Update Tags' : 'Add Tags' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection