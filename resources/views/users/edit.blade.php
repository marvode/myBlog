@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">My Profile</div>
				<div class="card-body">
				@include('partials.errors')
				<form action="{{ route('users.update-profile') }}" method="post">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label for='name'>Name</label>
						<input type="text" class="form-control" placeholder="Name" id='name' name="name" value="{{ $user->name }}">
					</div>
					<div class="form-group">
						<label for="about">About</label>
						<textarea name="about" id="about" rows="5" class="form-control">{{ $user->about }}</textarea>
					</div>
					<button type="submit" class="btn btn-success">Update Profile</button>
				</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection