<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;

class PostController extends Controller
{

    public function index()
    {
        $allPosts = Post::all(); //select * from posts

        return PostResource::collection($allPosts);

        // $response = [];

        // foreach ($allPosts as $post) {
        //     $response[] = [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'description' => $post->description,
        //     ];
        // }

        // return $response;
    }

    public function show(string $id)
    {
        $post = Post::find($id);
        return new PostResource($post);

        // return [
        //     'id' => $post->id,
        //     'title' => $post->title,
        //     'description' => $post->description,
        // ];
    }

    public function store(StorePostRequest $request) //type hinting
    {
        $id = request()->id;
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->postCreator;
        $slug = Str::slug($title);
        $post = Post::create([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            'slug' => $slug
        ]);
        return new PostResource($post);

        // return [
        //     'id' => $post->id,
        //     'title' => $post->title,
        //     'description' => $post->description,
        // ];
    }
}
