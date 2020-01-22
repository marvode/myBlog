@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h5>Users</h5>
        </div>
        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div style="max-width: 40px;">
                                    <img src="{{ Gravatar::src($user->email) }}" class="img-fluid" style='border-radius:50%'>
                                </div>
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                @if(!$user->isAdmin()) 
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                        @csrf
                                        <button type='submit' class="btn btn-outline-secondary">Make Admin</button>
                                    </form>
                                @endif
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
