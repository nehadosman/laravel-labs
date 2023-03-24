@extends('layouts.app')

@section('title') create @endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title" class="form-label">Upload Image </label>
        <input type="file" class="form-control" name="image" required>
    </div>

    <div>
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div>
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control h-75" id="description" name="description">
    </div>
    <div>
        <label for="PostCreator" class="form-label">Post Creator</label>
        <select class="form-control" id="PostCreator" name="postCreator" required>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}} </option>
            @endforeach
        </select>
        <!-- <input type="text" class="form-control" id="PostCreator" name="postCreator" required> -->
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection