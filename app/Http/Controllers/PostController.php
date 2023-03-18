<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'Laravel',
                'posted_by' => 'nehad',
                'created_at' => '2022-08-01 10:00:00'
            ],

            [
                'id' => 2,
                'title' => 'PHP',
                'posted_by' => 'osman',
                'created_at' => '2022-08-01 10:00:00'
            ],

            [
                'id' => 3,
                'title' => 'Javascript',
                'posted_by' => 'shady',
                'created_at' => '2022-08-01 10:00:00'
            ],
        ];

        return view('post.index', ['posts' => $posts]);
    }

    public function show(string $id)
    { {
            $post =  [
                'id' => 3,
                'title' => 'Javascript',
                'posted_by' => 'Ali',
                'created_at' => '2022-08-01 10:00:00',
                'description' => 'hello description',
            ];

            return view('post.show', ['post' => $post]);
        }
    }
    public function create()
    {
        return view('post.create');
    }

    public function edit()
    {
        $post =  [
            'title' => 'Laravel',
            'posted_by' => 'nehad',
            'description' => 'Laravel framework '
        ];
        return view('post.edit', ['post' => $post]);
    }
    public function store()
    {
        return redirect()->route('posts.index');
    }
}
