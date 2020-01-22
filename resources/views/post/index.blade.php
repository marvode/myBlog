@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('post.create') }}" class="btn btn-outline-success">New Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            <h5>Post</h5>
        </div>
        <div class="card-body">
            @if($posts->count() > 0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <div style="max-width: 160px;">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid">
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('blog.show', $post->id) }}">{{ $post->title }}</a>
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $post->category_id) }}" style="text-decoration: none;">{{ $post->category->name }}</a>
                            </td>
                            <td>
                                <span class="btn-group float-right">
                                    @if(!$post->trashed())
                                        <a class="btn btn-outline-info rounded-circle mr-2" href="{{ route('post.edit', $post->id) }}">Edit</a>
                                        <form method="POST" action="{{ route('post.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger rounded-circle">Trash</button>
                                        </form>
                                    @else
                                        <form action="{{ route('post.restore', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-success rounded-circle mr-2">Restore</button>
                                        </form>
                                        <button class="btn btn-outline-danger rounded-circle" onclick="handlePostDelete({{ $post->id }}, '{{ $post->title }}')">Delete</button>
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Post at the moment</h3>
            @endif
        </div>
        @if(Route::currentRouteName() === 'post.trashed-post')
            <form action="" method="POST" id="postDeleteForm">
                @method("DELETE")
                @csrf
                <div class="modal fade" id="postDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Delete Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                function handlePostDelete(id, title) {
                    document.getElementById('postDeleteForm').action = '/post/' + id;
                    document.getElementById('modalLabel').innerHTML = 'Delete Post: ' + title;
                    $('#postDeleteModal').modal('show');
                }
            </script>
        @endif
    </div>
@endsection
