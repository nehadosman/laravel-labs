<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
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

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:posts', 'min:3'],
            'description' => ['required', 'min:10'],
            'postCreator' => ['required', 'exists:users,id']
        ]);
        $post = Post::find($id);
        $post->title = request()->title;
        $post->description = request()->description;
        $post->user_id = request()->postCreator;
        $post->update();
        return to_route("posts.index");
    }
    public function store(StorePostRequest $request) //type hinting
    {
        $id = request()->id;
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->postCreator;
        $slug = Str::slug($title);

        $file_extenstion = request()->file('image')->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extenstion;
        $path = 'images';
        $image = $request->image->move($path, $file_name);

        $post = Post::create([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            'image_path' => $file_name,
            'slug' => $slug
        ]);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $path = $image->storeAs('public/images', $image->getClientOriginalName());
        //     $post->image_path = $path;
        // }
        // // $data = $request->all();
        // return redirect()->route('posts.index');
        return to_route("posts.index");
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    // public function pruneOldPosts()
    // {
    //     PruneOldPostsJob::dispatch();
    //     return "Old posts pruning job dispatched!";
    // }
}
