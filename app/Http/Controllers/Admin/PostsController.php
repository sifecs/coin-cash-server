<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Currencys;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        $user = Auth::user();
        return view('admin.posts.index',['posts'=> $posts,'user'=>$user]);
    }

    public function create()
    {
        $currency = Currencys::pluck('title','id')->all();
        $categories = Category::pluck('title','id')->all();
        return view('admin.posts.create',['currency' => $currency, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'date'=> 'required',
            'cumma'=> 'required|numeric',
            'category_id'=> 'required|numeric',
            'currency_id'=> 'required|numeric',
        ]);

        $user = User::find(Auth::id());

        $user->balans($request->get('category_id'), $request->get('cumma'));

        $post = Post::add($request->all());
        $post->setСurrency($request->get('currency_id'));

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $currencys = Currencys::pluck('title','id')->all();
        $categories = Category::pluck('title','id')->all();
        return view('admin.posts.edit',['currencys' => $currencys, 'categories' => $categories, 'post'=>$post]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=> 'required',
            'date'=> 'required',
            'cumma'=> 'required|numeric',
            'category_id'=> 'required|numeric',
            'currency_id'=> 'required|numeric',
        ]);
        $post = Post::find($id);
        $user = Auth::user();

        $user->balans($request->get('category_id'), $request->get('cumma'));

        $post->edit($request->all());
        $post->setCategory($request->get('category_id'));
        $post->setСurrency($request->get('tags'));
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::find($id)->remove();
        return redirect()->route('posts.index');
    }

}
