@extends('layouts.app')

@section('title') create @endsection
@section('content')
<form action="{{ route('posts.store')}}" method="post">
    @csrf
    <div>
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div>
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control h-75" id="description" name="description" required>
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