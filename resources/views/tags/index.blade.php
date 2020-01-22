@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('tags.create') }}" class="btn btn-outline-success my-2">Add Tag</a>
    </div>
    <div class="card">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Post Count</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->posts->count() }}</td>
                            <td>
                                <div class="float-right">
                                    <a class="btn btn-outline-info rounded-circle" href="{{ route('tags.edit', $tag->id) }}">Edit</a>
                                    <button class="btn btn-outline-danger rounded-circle" onclick="handleTagDelete({{ $tag->id }}, '{{ $tag->name }}')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No tags yet</h3>
            @endif

            <form action="" method="POST" id="tagDeleteForm">
                @method("DELETE")
                @csrf
                <div class="modal fade" id="tagDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Delete Tag</h5>
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

        </div>
    </div>
    <script>
        function handleTagDelete(id, name) {
            document.getElementById('tagDeleteForm').action = '/tags/' + id;
            document.getElementById('modalLabel').innerHTML = 'Delete Tag: ' name;
            $('#tagDeleteModals').modal('show');
        }

    </script>
@endsection