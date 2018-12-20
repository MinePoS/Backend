<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\VirtualCurrency;
class VirtualCurrenciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function listCurrencies(){
        return view('admin.pages.settings.virtualcurrencies.listcurrencies');
    }

    public function addCurrency(){
    	return view('admin.pages.settings.virtualcurrencies.form');
    }

    public function saveCurrency(){
    	$currency = null;
    	$wasMade = false;
    	if(Request("id") != null && Request("id") != ""){
    		$id = Request("id");
    		$currency = VirtualCurrency::findOrFail($id);
    		$wasMade = true;
    	}

    	if($currency == null){
    		$currency = new VirtualCurrency;
    	}

    	$currency->name = Request("name");
    	$currency->worth = Request("worth");
    
    	$currency->save();

		if($wasMade){
			session()->flash('good', $currency->name." was updated!");
		}else{
			session()->flash('good', $currency->name." was created!");
		}
    	

        return redirect()->route('admin.settings.virtualcurrencies');
    }

public function deleteCurrency(VirtualCurrency $currency){
    $currency->delete();
session()->flash('good', $currency->name." was deleted!");
return redirect()->route('admin.settings.virtualcurrencies');
}

	public function editCurrency(VirtualCurrency $currency){
    	return view('admin.pages.settings.virtualcurrencies.form',["currency"=>$currency]);
    }

public function listTransactions(){
    $transactions = \App\VirtualTransaction::latest()->paginate(10);
    return view('admin.pages.virtualcurrencies.transactions.index',["transactions"=>$transactions]);
}
        
}