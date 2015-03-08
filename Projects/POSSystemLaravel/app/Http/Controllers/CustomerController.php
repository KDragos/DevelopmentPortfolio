<?php namespace App\Http\Controllers;

use DB;

// This would 
// use App\Library\TestClass;

class CustomerController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Customer Controller
	|--------------------------------------------------------------------------
	*/

	/**
	 * Show all customers screen to the user.
	 */
	public function all(){
		$customers = DB::select('select * from customer');
		return view("customer", ["customers"=>$customers]);
		
		// This was used for Brad's demo. 
		// $foo = new TestClass;
		// return $foo->bar();
	}

	/**
	 * Show just one customer profile to the user.
	 */
	public function justOne($id) {
		$customer = DB::select(
			'select * from customer where customer_id = :id',
			[':id' => $id]);
		return view('singleCustomer', ['customer' => $customer[0]]);
	}



}



