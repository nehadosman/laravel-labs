<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'body' => 'required',
    //     ]);
    //     $input = $request->all();
    //     $input['user_id'] = auth()->user()->id;
    //     Comment::create($input);
    //     return back();
    // }

    // public function update(Request $request, $id)
    // {
    //     $comment = Comment::findO($id);
    //     $comment->body = $request->body;
    //     $comment->save();
    //     return back();
    // }


    // public function destroy($id)
    // {
    //     $comment = Comment::findO($id);
    //     $comment->delete();
    //     return back();
    // }
}
