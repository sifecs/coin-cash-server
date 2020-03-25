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
            'amount'=> 'required|numeric',
            'category_id'=> 'required|numeric',
            'currency_id'=> 'required|numeric',
        ]);

        $user = User::find(Auth::id());
        $user->update_balans_user($request->get('category_id'), $request->get('amount'));

        $all = $request->all();
        $all['date'] =   $request->get('date', date('Y-m-d'));
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
            'date'=> 'nullable|date_format:Y-m-d',
            'amount'=> 'required|numeric',
            'category_id'=> 'required|numeric',
            'currency_id'=> 'required|numeric',
        ]);

        $financ = Finance::find($id);
        $user = Auth::user();

        $user->update_balans_user($request->get('category_id'), $request->get('amount'));

        $all = $request->all();
        $all['date'] =   $request->get('date', date('Y-m-d'));

        $financ->edit($all);
        return redirect()->route('finance.index');
    }

    public function destroy($id)
    {
        Finance::find($id)->delete();
        return redirect()->route('finance.index');
    }
}
