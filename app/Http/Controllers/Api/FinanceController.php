<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Finance;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{

    public function index(Request $request)
    {
        $this->validate($request,[
            'date_from' => 'nullable|date_format:Y-m-d',
            'date_to' => 'nullable|date_format:Y-m-d',
            'categories' => 'nullable',
        ]);

        $user = $request->user();

        $finance = $user->Finance()
            ->orderBy('date', 'DESC')
            ->whereBetween('date', [
                $request->get('date_from', $user->Finance()->oldest('date')->first()->date),
                $request->get('date_to', $user->Finance()->latest('date')->first()->date)])
//            ->join('categories', 'category_id', '=', 'categories.id')
            ->whereIn('category_id',  explode(',', $request->get('categories' , Category::pluck('id')->implode(',')) ))
            ->paginate(3);

        foreach ($finance as $value) {
            $value->category =  Category::find($value->category_id);
        }

        return response()->json($finance,'200');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'date'=> 'nullable|date_format:Y-m-d',
            'amount'=> 'required',
            'category_id'=> 'required',
            'comment' => 'nullable',
        ]);
        if (!in_array($request->get('category_id'), $categories = Category::pluck('id')->all())) {
            return response()->json('В базе нету такой категории','403');
        }

        $all = $request->all();
        $all['date'] =   $request->get('date', date('Y-m-d'));

        $user = $request->user();
        $user->update_balans_user($request->get('category_id'), $request->get('amount'));

        $financ = Finance::add($all);

        $financ['caterogy'] = $financ->category()->find($request->get('category_id'));
        return response()->json($financ,'200');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'date'=> 'nullable|date_format:Y-m-d',
            'amount'=> 'required',
            'category_id'=> 'required',
            'comment' => 'nullable',
        ]);
        if (!in_array($request->get('category_id'), $categories = Category::pluck('id')->all())) {
            return response()->json('В базе нету такой категории','403');
        }

        $user = $request->user();
        $userID = $user->id;
        $financUser = Finance::where('user_id', $userID)->find($id);
        if ($financUser != null) {
            $all = $request->all();
            $all['date'] =   $request->get('date', date('Y-m-d'));

            $financUser->edit($all);
            $user->update_balans_user($request->get('category_id'), $request->get('amount'));

            $category =  $financUser->category()->get()->find($request->get('category_id'));
            $financUser['caterogy'] = $category;
            return response()->json($financUser,'200');
        }
        return response()->json(['Finance'=> $financUser, 'message'=>'У даного пользователя нету поста с таким айди'],'403');
    }

    public function destroy(Request $request ,$id)
    {
        $userID = $request->user()->id;
        $financUser = Finance::where('user_id', $userID)->find($id);
        if ($financUser != null) {
            $financUser->delete();
            return response()->json($financUser,'200');
        }
        return response()->json(['Finance'=> $financUser, 'message'=>'У даного пользователя нету поста с таким айди'],'403');
    }

}
