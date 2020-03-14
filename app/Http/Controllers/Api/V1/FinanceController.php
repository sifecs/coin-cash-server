<?php

namespace App\Http\Controllers\Api\V1;

use App\Finance;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{

    public function index(Request $request)
    {
        $userID = $request->user()->id;
        $finance = DB::table('finance')->where('user_id', $userID)->get();
        return response()->json(['Finance'=> $finance,'message'=>'OK'],'200');
    }
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

        $user->update_balans_user($request->get('category_id'), $request->get('cumma'));
        $financ = Finance::add($request->all());
        $financ->setCategory($request->get('category_id'));
        $financ->setСurrency($request->get('currency_id'));
        return response()->json(['Finance'=>$financ,'message'=>'OK'],'200');
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
        $userID = $user->id;
        $finance = Finance::all();
        $financUser = $finance->where('user_id', $userID)->find($id);

        if ($financUser != null) {
            $financUser->edit($request->all());

            $user->update_balans_user($request->get('category_id'), $request->get('cumma'));

            $financUser->setCategory($request->get('category_id'));
            $financUser->setСurrency($request->get('tags'));
            return response()->json(['Finance'=>$financUser,'message'=>'OK'],'200');
        }
        return response()->json(['Finance'=> $financUser, 'message'=>'У даного пользователя нету поста с таким айди'],'404');
    }

    public function destroy(Request $request ,$id)
    {
        $userID = $request->user()->id;
        $finance = Finance::all();
        $financUser = $finance->where('user_id', $userID)->find($id);

        if ($financUser != null) {
            Finance::find($id)->remove();
            return response()->json(['Finance'=> $financUser, 'message'=>'OK Удалено'],'200');
        }
        return response()->json(['Finance'=> $financUser, 'message'=>'У даного пользователя нету поста с таким айди'],'404');
    }

    public function income(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'date'=> 'required',
            'cumma'=> 'required',
            'currency_id'=> 'required',
        ]);

        $user = $request->user();

        $user->update_balans_user($request->get('category_id'), $request->get('cumma'));
        $financ = Finance::add($request->all());
        $income = User::CATEGORY_ID_INCOME ;
        $financ->setCategory($income);
        $financ->setСurrency($request->get('currency_id'));
        return response()->json(['Finance'=>$financ,'message'=>'OK'],'200');
    }

    public function expenses(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'date'=> 'required',
            'cumma'=> 'required',
            'currency_id'=> 'required',
        ]);

        $user = $request->user();

        $user->update_balans_user($request->get('category_id'), $request->get('cumma'));
        $financ = Finance::add($request->all());
        $expenses = User::CATEGORY_ID_EXPENSES ;
        $financ->setCategory($expenses);
        $financ->setСurrency($request->get('currency_id'));
        return response()->json(['Finance'=>$financ,'message'=>'OK'],'200');
    }

}
