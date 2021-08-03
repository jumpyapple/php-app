<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostDislike;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function like(\App\Models\Post $post) {
        $post_like = PostLike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->first();
        $post_dislike = PostDislike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->first();
        if ($post_like !== null) {
            // If there is like, remove the like.
            PostLike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->delete();
            $post->likes = $post->likes - 1;
            $post->save();
        } else if ($post_dislike !== null) {
            // If there is a dislike, remove the dislike, and add like.
            PostDislike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->delete();

            $post->dislikes = $post->dislikes - 1;
            $post->likes = $post->likes + 1;
            $post->save();

            $post_like = new PostLike();
            $post_like->user_id = 1;
            $post_like->post_id = $post->id;
            $post_like->save();
        } else {
            // User never like or dislike, we just gonna like it.
            $post_like = new PostLike();
            $post_like->user_id = 1;
            $post_like->post_id = $post->id;
            $post_like->save();

            $post->likes = $post->likes + 1;
            $post->save();
        }

        return redirect('/posts');
    }

    public function dislike(\App\Models\Post $post) {
        $post_like = PostLike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->first();
        $post_dislike = PostDislike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->first();
        if ($post_like !== null) {
            // If there is a like, remove the like, and add dislike.
            PostLike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->delete();

            $post->likes = $post->likes - 1;
            $post->dislikes = $post->dislikes + 1;
            $post->save();

            $post_dislike = new PostDislike();
            $post_dislike->user_id = 1;
            $post_dislike->post_id = $post->id;
            $post_dislike->save();
        } else if ($post_dislike !== null) {
            // If there is a dislike, remove the dislike.
            PostDislike::where('user_id', '=', 1)->where('post_id', '=', $post->id)->delete();
            $post->dislikes = $post->dislikes - 1;
            $post->save();
        } else {
            // User never like or dislike, we just gonna dislike it.
            $post_dislike = new PostDislike();
            $post_dislike->user_id = 1;
            $post_dislike->post_id = $post->id;
            $post_dislike->save();

            $post->dislikes = $post->dislikes + 1;
            $post->save();
        }

        return redirect('/posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
