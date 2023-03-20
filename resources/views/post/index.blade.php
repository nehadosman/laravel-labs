@extends('layouts.app')


@section('title') Index @endsection

@section('content')
<div class="text-center">
    <button type="button" class="mt-4 btn btn-success"><a href="{{route('posts.create')}}" style="text-decoration:none"> Create Post</button>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->created_at}}</td>
            <td>
                <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-primary">Edit</a>
                <!-- <a data-confirm="Are you sure?" data-method="delete" href="{{route('posts.destroy', $post['id'])}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a> -->
                <form method="POST" action="{{route('posts.destroy',$post->id)}}" style="display: contents;" onclick="return confirm('Are you sure?')">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" value="">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection