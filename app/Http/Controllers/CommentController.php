<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = $request->commentable_type;
        $comment->save();
        return back();
    }
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->save();
        return back();
    }
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
