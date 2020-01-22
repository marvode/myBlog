@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('categories.create') }}" class="btn btn-outline-success my-2">Add Category</a>
    </div>
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Post Count</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->posts->count() }}</td>
                            <td>
                                <div class="float-right">
                                    <a class="btn btn-outline-info rounded-circle" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                    <button class="btn btn-outline-danger rounded-circle" onclick="handleCategoryDelete({{ $category->id }}, '{{ $category->name }}')">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No categories yet</h3>
            @endif

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                </button>

            <form action="" method="POST" id="categoryDeleteForm">
                @method("DELETE")
                @csrf
                <div class="modal fade" id="categoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Delete Category</h5>
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
        function handleCategoryDelete(id, name) {
            document.getElementById('categoryDeleteForm').action = '/categories/' + id;
            document.getElementById('modalLabel').innerHTML = 'Delete Category: ' name;
            $('#categoryDeleteModal').modal('show');
        }

    </script>
@endsection