<?php

namespace App\Http\Controllers\Admin;

use App\Finance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Currencys;
use App\User;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $financs = Finance::all();
        $user = Auth::user();
        return view('admin.finance.index',['finance'=> $financs,'user'=>$user]);
    }

    public function create()
    {
        $currency = Currencys::pluck('title','id')->all();
        $categories = Category::pluck('title','id')->all();
        return view('admin.finance.create',['currency' => $currency, 'categories' => $categories]);
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

        $user->update_balans_user($request->get('category_id'), $request->get('cumma'));

        $financ = Finance::add($request->all());
        $financ->setСurrency($request->get('currency_id'));

        return redirect()->route('finance.index');
    }

    public function edit($id)
    {
        $financ = Finance::find($id);
        $currencys = Currencys::pluck('title','id')->all();
        $categories = Category::pluck('title','id')->all();
        return view('admin.finance.edit',['currencys' => $currencys, 'categories' => $categories, 'financ'=>$financ]);

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
        $financ = Finance::find($id);
        $user = Auth::user();

        $user->update_balans_user($request->get('category_id'), $request->get('cumma'));

        $financ->edit($request->all());
        $financ->setCategory($request->get('category_id'));
        $financ->setСurrency($request->get('tags'));
        return redirect()->route('finance.index');
    }

    public function destroy($id)
    {
        Finance::find($id)->remove();
        return redirect()->route('finance.index');
    }

}
