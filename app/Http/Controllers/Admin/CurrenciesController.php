<?php

namespace App\Http\Controllers\Admin;

use App\Currencys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrenciesController extends Controller
{

    public function index()
    {
        $currencys = Currencys::all();
        return view('admin.Currencies.index',['currencys'=> $currencys]);
    }

    public function create()
    {
        return view('admin.Currencies.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required'
        ]);
        Currencys::create($request->all());
        return redirect()->route('currencies.index');
    }

    public function edit($id)
    {
        $currency = Currencys::find($id);
        return view('admin.Currencies.edit', ['currency'=>$currency]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' =>'required'
        ]);
        $currencys = Currencys::find($id);
        $currencys->update($request->all());
        return redirect()->route('currencies.index');
    }

    public function destroy($id)
    {
        Currencys::find($id)->delete();
        return redirect()->route('currencies.index');
    }
}
