<?php

namespace App\Http\Controllers\Api\V1;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $userID = $request->user()->id;
        $posts = DB::table('posts')->where('user_id', $userID)->get();
        return response()->json(['posts'=> $posts,'message'=>'OK'],'200');
    }
//[
//{ id, ...},
//{ id, ...},
//{ id, ...},
//...
//]
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'date'=> 'required',
            'cumma'=> 'required',
            'category_id'=> 'required',
            'currency_id'=> 'required',
        ]);

        $user = $request->user();

        $user->balans($request->get('category_id'), $request->get('cumma'));
        $post = Post::add($request->all());
        $post->setCategory($request->get('category_id'));
        $post->setСurrency($request->get('currency_id'));
        return response()->json(['posts'=>$post,'message'=>'OK'],'200');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=> 'required',
            'date'=> 'required',
            'cumma'=> 'required',
            'category_id'=> 'required',
            'currency_id'=> 'required',
        ]);

        $user = $request->user();
        $userPosts = $this->index($request);
        $userPost = $userPosts->original['posts']->find($id);

        if ($userPost != null) {
            $userPost->edit($request->all());

            $user->balans($request->get('category_id'), $request->get('cumma'));

            $userPost->setCategory($request->get('category_id'));
            $userPost->setСurrency($request->get('tags'));
            return response()->json(['post'=>$userPost,'message'=>'OK'],'200');
        }
        return response()->json(['post'=> $userPost, 'message'=>'У даного пользователя нету поста с таким айди'],'404');
    }

    public function destroy(Request $request ,$id)
    {
      $userPosts = $this->index($request);
      $userPost = $userPosts->original['posts']->find($id);

      if ($userPost != null) {
          Post::find($id)->remove();
          return response()->json(['post'=> $userPost, 'message'=>'OK Удалено'],'200');
      }
        return response()->json(['post'=> $userPost, 'message'=>'У даного пользователя нету поста с таким айди'],'404');
    }
}
