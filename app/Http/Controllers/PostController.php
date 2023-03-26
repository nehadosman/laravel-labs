<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;


class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::paginate(10);
        $posts = Post::with('user')->paginate(5);
        return view('post.index', ['posts' => $posts]);
    }

    public function show(string $id)
    {
        $post = Post::find($id);

        return view('post.show', ['post' => $post]);
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
        $post = Post::find($id);
        if ($post->title == request()->title) {
            $request->validate([
                'title' => ['required', 'min:3'],
                'description' => ['required', 'min:10'],
                'postCreator' => ['required', 'exists:users,id']
            ]);
        } else {
            $request->validate([
                'title' => ['required', 'unique:posts', 'min:3'],
                'description' => ['required', 'min:10'],
                'postCreator' => ['required', 'exists:users,id']
            ]);
        }

        $post->title = request()->title;
        $post->description = request()->description;
        $post->user_id = request()->postCreator;

        $file_extenstion = request()->file('image')->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extenstion;
        $path = 'images';
        $request->image->move($path, $file_name);

        $post->image_path = request()->image;

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
        $request->image->move($path, $file_name);

        $post = Post::create([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            'image_path' => $file_name,
            'slug' => $slug
        ]);
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

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubCallback()
    {
        try {
            $user = Socialite::driver('github')->stateless()->user();
            $user = User::where('email', $user->email)->first();
            if ($user) {
                Auth::login($user);
                return to_route('posts.index');
            }
            $user = new User();
            $user->name = $user->name;
            $user->email = $user->email;
            $user->password = Hash::make(Str::random(24));
            $user->save();
            Auth::login($user);
            return to_route('posts.index');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return to_route('posts.index');
            }
            $user = new User();
            $user->name = $user->name;
            $user->email = $user->email;
            $user->password = Hash::make(Str::random(24));
            $user->save();
            Auth::login($user);
            return to_route('posts.index');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
