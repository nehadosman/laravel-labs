@extends('layouts.app')

@section('title') edit @endsection
@section('content')
<form action="{{route('posts.store')}}" method="post">
    @csrf
    <div>
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" value="{{$post['title']}}">
    </div>
    <div>
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control h-75" id="description" value="{{$post['description']}}">
    </div>
    <div>
        <label for="PostCreator" class="form-label">Post Creator</label>
        <input type="text" class="form-control" id="PostCreator" value="{{$post['posted_by']}}" required>
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
@endsection