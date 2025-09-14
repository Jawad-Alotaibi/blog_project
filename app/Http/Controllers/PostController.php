<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{


    /**
     * When the user types into the search input the JS waits until they stop typing (debounce),
     * then sends an AJAX request (axios) to your Laravel search action which runs a search on Post,
     *  returns matching posts as JSON (with the post authors loaded), and the JS renders those results into the overlay DOM safely using DOMPurify.
     */
    public function search($term)
    {
    // Post::where('title', 'LIKE', '%'. $term. '%')->orWhere('body', 'LIKE', '%'. $term. '%')->with('user:id,username,avatar')->get();
        $posts = Post::search($term)->get();
        $posts->load('user:id,username,avatar');
        return $posts;
    }

    public function showCreatePostForm()
    {
        return view('createPost');
    }

    public function storeNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'Required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);


        $incomingFields['user_id'] = Auth::id();

       $newPost =  Post::create([
            'title' => $incomingFields['title'],
            'body' => $incomingFields['body'],
            'user_id' => $incomingFields['user_id']

        ]);

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created');

        }


        public function showSinglePost(Post $post)
        {
            $post['body'] = strip_tags(Str::markdown($post->body), '<p><h1><h2><h3><h4><h5><h6><ul><li><ol><em><br>');
            return view('single-post', ['post' => $post]);
        }

        public function delete(Post $post)
        {
             $post->delete();
            return redirect('/profile/' . Auth::user()->username)->with('success', 'Post deleted successfully');
        }

        public function showEditPostForm(Post $post)
        {
            return view('edit-post', ['post' => $post]);
        }

        public function update(Post $post, Request $request)
        {
            $incomingFields = $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);

            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['body'] = strip_tags($incomingFields['body']);

            $post->update($incomingFields);
            return redirect('/post/' . $post->id)->with('success', 'Post updated successfully');

        }
}
