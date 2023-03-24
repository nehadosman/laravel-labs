@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="card mt-6">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$post->title}}</h5>
        <h5 class="card-title">Title: {{$post->slug}}</h5>
        <p class="card-text">Description: {{$post->description}}</p>
        <p class="card-text">Post Creator: {{$post->User->name}}</p>
        <p class="card-text">Created at: {{$post->created_at}}</p>
    </div>
</div>



<div class="card mt-6">
    <div class="card-header">
        Post Creator Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    </div>
</div>

@foreach($post->comments as $comment)
<div class="card" style="margin-top: 10px;">
    <div class="card-header">
        Comment:
    </div>
    <div class="card-body">
        <p class="card-text">{{$comment->comment}}</p>
        <div class="btn-group">
            <button type="button" class="btn btn-primary edit-comment-btn" data-comment-id="{{$comment->id}}">Edit</button>

            <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

        <form method="POST" action="{{ route('comments.update', $comment) }}" style="display:none;" id="edit-comment-form-{{$comment->id}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" id="body" name="comment" rows="3">{{$comment->comment}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endforeach


<div class="card" style="margin-top: 10px;">
    <div class="card-header">
        Insert Comment
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" id="body" name="comment" rows="3"></textarea>
            </div>
            <input type="hidden" name="commentable_id" value="{{ $post->id }}">
            <input type="hidden" name="commentable_type" value="App\Models\Post">
            <input type="hidden" name="comment_id" value="{{ isset($comment) ? $comment->id : '' }}">
            <button type="submit" class="btn btn-primary">Insert</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editCommentBtns = document.querySelectorAll('.edit-comment-btn');
        editCommentBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var commentId = this.getAttribute('data-comment-id');
                var editCommentForm = document.getElementById('edit-comment-form-' + commentId);
                if (editCommentForm.style.display === 'none') {
                    editCommentForm.style.display = 'block';
                } else {
                    editCommentForm.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection