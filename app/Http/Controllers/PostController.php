<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //query to select all from posts
        $posts = Post::paginate(5); 
        // $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }

    public function show(string $id)
    { {
            $post = Post::find($id);

            return view('post.show', ['post' => $post]);
        }
    }
    public function create()
    {
        $users = User::all();
        return view('post.create', ["users" => $users]);
    }

    public function edit(string $id)
    {
        $post = Post::find($id);
        $users = User::all();

        return view('post.edit', ['post' => $post, 'users' => $users]);
    }

    public function update($id)
    {
        $post = Post::find($id);
        $post->title = request()->title;
        $post->description = request()->description;
        $post->user_id = request()->postCreator;
        $post->update();
        return to_route("posts.index");
    }
    public function store(Request $request) //type hinting
    {
        $id = request()->id;
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->postCreator;

        Post::create([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);
        // $data = $request->all();
        // return redirect()->route('posts.index');
        return to_route("posts.index");
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
