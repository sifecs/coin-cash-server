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

        if ($request->get('date_from') != null && $request->get('date_to') != null) {
            $date_from = $request->get('date_from');
            $date_to = $request->get('date_to');
        } else {
            $date_to = $user->Finance()->latest('date')->first()->date;
            $date_from = $user->Finance()->oldest('date')->first()->date;
        }

        if ($request->get('categories') != null) {
          $categories = explode(',', $request->get('categories'));

        } else {
            $a = Category::all();
            $categories = [];
            foreach ($a as $value) {
                array_push( $categories, $value->id );
            }
        }

        $finance = $user->Finance()
            ->orderBy('date', 'DESC')
            ->whereBetween('date', [$date_from, $date_to])
            ->whereIn('category_id', $categories)
            ->paginate(2);
        $categories = Category::all();
        foreach ($finance as $value) {
            $categorie = $categories->find($value->category_id);
            $value->category = $categorie;
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

        $user = $request->user();
        if (!$request->get('date')) {
          $all = $request->all();
          $all['date'] = date('Y-m-d');
        } else {
            $all = $request->all();
        }

        $user->update_balans_user($request->get('category_id'), $request->get('amount'));
        $financ = Finance::add($all);
        $financ->setCategory($request->get('category_id'));
        $category =  $financ->category()->get()->find($request->get('category_id'));
        $financ['caterogy'] = $category;
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

        $user = $request->user();
        $userID = $user->id;
        $finance = Finance::all();
        $financUser = $finance->where('user_id', $userID)->find($id);

        if ($financUser != null) {

            if (!$request->get('date')) {
                $all = $request->all();
                $all['date'] = date('Y-m-d');
            } else {
                $all = $request->all();
            }

            $financUser->edit($all);

            $user->update_balans_user($request->get('category_id'), $request->get('amount'));
            $financUser->setCategory($request->get('category_id'));
            $category =  $financUser->category()->get()->find($request->get('category_id'));
            $financUser['caterogy'] = $category;
            return response()->json($financUser,'200');
        }
        return response()->json(['Finance'=> $financUser, 'message'=>'У даного пользователя нету поста с таким айди'],'403');
    }

    public function destroy(Request $request ,$id)
    {
        $userID = $request->user()->id;
        $finance = Finance::all();
        $financUser = $finance->where('user_id', $userID)->find($id);

        if ($financUser != null) {
            Finance::find($id)->remove();
            return response()->json($financUser,'200');
        }
        return response()->json(['Finance'=> $financUser, 'message'=>'У даного пользователя нету поста с таким айди'],'403');
    }

    public function income(Request $request)
    {
        $this->validate($request,[
            'date'=> 'nullable|date_format:Y-m-d',
            'amount'=> 'required',
            'comment' => 'nullable',
        ]);

        $user = $request->user();

        if (!$request->get('date')) {
            $all = $request->all();
            $all['date'] = date('Y-m-d');
        } else {
            $all = $request->all();
        }

        $user->update_balans_user($request->get('category_id'), $request->get('amount'));

        $financ = Finance::add($all);
        $income = User::INCOME ;
        $financ->setCategory($income);
        $financ->setСurrency(1);
        return response()->json(['Finance'=>$financ,'message'=>'OK'],'200');
    }

    public function expenses(Request $request)
    {
        $this->validate($request,[
            'date'=> 'nullable|date_format:Y-m-d',
            'amount'=> 'required',
            'comment' => 'nullable',
        ]);

        $user = $request->user();

        if (!$request->get('date')) {
            $all = $request->all();
            $all['date'] = date('Y-m-d');
        } else {
            $all = $request->all();
        }

        $user->update_balans_user($request->get('category_id'), $request->get('amount'));
        $financ = Finance::add($all);
        $expenses = User::EXPENSES ;
        $financ->setCategory($expenses);
        $financ->setСurrency(1);
        return response()->json(['Finance'=>$financ,'message'=>'OK'],'200');
    }

}
