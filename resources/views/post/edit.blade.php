@extends('layouts.app')

@section('title') edit @endsection
@section('content')
<form action="{{route('posts.update', $post['id'])}}" method="post">
    @csrf
    <div>
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$post['title']}}">
    </div>
    <div>
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control h-75" id="description" name="description" value="{{$post['description']}}">
    </div>
    <div>
        <label for="PostCreator" class="form-label">Post Creator</label>
        <select class="form-control" id="PostCreator" name="postCreator" required>
            @foreach($users as $user)
            <option @if($user->id == $post->user_id) selected @endif
                value="{{$user->id}}">{{$user->name}} </option>
            @endforeach
        </select>

        <!-- <input type="text" class="form-control" id="PostCreator" name="postCreator" value="{{$post->user->name}}" required> -->
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
@endsection