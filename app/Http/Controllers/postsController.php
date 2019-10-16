<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\post;
use DB;

class postsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth',['except' => ['index', 'show'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //url: "/posts"

        //$posts = post::all();
        //$posts = post::all()->take(1);
        //$posts = post::orderBy('created_at', 'desc')->get();
        //$posts = post::orderBy('created_at', 'desc')->take(1)->get();
        //$posts = post::where('title', 'post two')->get();
        //$posts = post::orderBy('created_at', 'desc')->paginate(1);
        //{{$posts->links()}} in the posts.index
        //$posts = DB::select("SELECT * FROM posts");

        $posts = post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')) {
            $filename_w_ext = $request->file('cover_image')->getClientOriginalName();
            $filename_wo_ext = pathinfo($filename_w_ext, PATHINFO_FILENAME);
            $filename_ext = $request->file('cover_image')->getClientOriginalExtension();

            $filename_to_store = $filename_wo_ext . "_" . time() . "_" . $filename_ext;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filename_to_store);
        } else {
                $filename_to_store = "no_image.jpg";
        }

        $post = new post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filename_to_store;
        $post->save();
        return redirect('/posts')->with('success', "Post Created Sucessfully !");
        //return 123;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //url: "/posts/{{id}}"
       
        //return post::where('id', $id)->get();
        //$post = post::where('title', 'post one')->get();

        $post = post::find($id);
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
        //
        $post = post::find($id);
        if($post->user_id != auth()->User()->id) {
            return redirect('/posts')->with('error', "Unauthorized Action performed");
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
        //
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'

        ]);
        
        if($request->hasFile('cover_image')) {
            $filename_w_ext = $request->file('cover_image')->getClientOriginalName();
            $filename_wo_ext = pathinfo($filename_w_ext, PATHINFO_FILENAME);
            $filename_ext = $request->file('cover_image')->getClientOriginalExtension();

            $filename_to_store = $filename_wo_ext . "_" . time() . "_" . $filename_ext;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filename_to_store);
        } else {
                $filename_to_store = "no_image.jpg";
        }

        $post = post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')) {
            $post->cover_image=$filename_to_store;
        }
        $post->save();

        return redirect('/posts')->with('success', "Post Updated Successfully... !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = post::find($id);
        if($post->user_id != auth()->User()->id) {
            return redirect('/posts')->with('error',"Unauthorized Actiopn performed");
        }
        $post->delete();

        return redirect('/posts')->with('success', "Post Deleted Successfully... !");
        
    }
}
