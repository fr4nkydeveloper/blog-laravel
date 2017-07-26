<?php 

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Like;
use App\Tag;
use App\Http\Requests;



class PostController extends Controller{

    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('blog.index', ['posts' => $posts]);
    }

    public function getIndexPost($id){
        //Con with le indicamos a laravel que ademas del post haga un query y nos de los likes relacionados
        $post = Post::where('id', $id)->with('likes')->first();
        return view('blog.post', ['post' => $post]);
        
    }

    public function getLikePost($id){
        $post = Post::where('id', $id)->first();
        $like = new Like();
        $post->likes()->save($like);
        return redirect()->back();
    }

 
    public function getAdmin(){
        $posts = Post::all();
        return view('admin.index', ['posts' => $posts]);
    }

  
    public function getAdminCreate(){
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function getAdminEdit($id){
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);

    }

    public function postAdminCreate(Request $request){
        $this->validate($request, [   //$this es el controlador, validate es un metodo que ya viene con el controlador
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        //Mass assignment is when you send an array to the model creation
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $post->save();
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Title is: ' . $request->input('title'));
    }

    public function postAdminUpdate(Request $request){
         $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        //$post->tags()->detach();
        //$post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        //con sync laravel sabra cuales tags cambiaron
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }

    public function getAdminDelete($id){
        $post = Post::find($id);
        $post->likes()->delete();
        $post-tags()->detach();
        $post->delete();
        return redirect()->route('admin.index')->with('info', 'Post deleted');
    }




 



}

