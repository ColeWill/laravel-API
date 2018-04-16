<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post; // Brings in the Post model
use DB; // --> allows use of SQL queries

class PostsController extends Controller
{
    // Auth
     public function __construct()
        {   // tells auth middleware what views are allowed w/o being logged in...
            $this->middleware('auth', ['except' => ['index', 'show']]);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	// $post = DB::select('SELECT * FROM posts'); --> insert SQL queries like this
    	// $posts = Post::orderBy('created_at', 'asc')->take(1)->get(); 
    	$posts = Post::orderBy('title','desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'title' => 'required',
        	'body' => 'required',
            'cover_image' => 'image|nullable|max:1987'
        ]);

        // Handles the file upload
        if($request->hasFile('cover_image')){
            // Get Filename w/ extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store --> makes filenames unique so NO duplicates
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else{
            $fileNameToStore = 'none.jpg';
        }

        // Create a Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; //gets id from currently logged in user
        $post->cover_image =$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	//stores the corresponding post from db in variable
        $post = Post::find($id);
        //returns the view posts/show + the data from the variable
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // auth to prevent users editing other's posts...
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Not Your Post!');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update a Post w/ matching id
        $this -> validate($request, [
        	'title' => 'required',
        	'body' => 'required'
        ]);

            // Handles the file upload
        if($request->hasFile('cover_image')){
            // Get Filename w/ extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store --> makes filenames unique so NO duplicates
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
         // auth to prevent users editing other's posts...
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'none.jpg'){
            //delete the image
            Storage::delete('public/cover_images/'.$post->cover_image);

        }

        $post->delete();
        return redirect('/posts')->with('error', 'Post Removed');
    }
}
