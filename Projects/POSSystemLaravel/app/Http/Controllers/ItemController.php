<?php namespace App\Http\Controllers;

use App\Library\ItemList;
use DB;

class ItemController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Item Controller
	|--------------------------------------------------------------------------
	*/

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function all() {
		$items = DB::select('select * from item');
		return view('item', ['items' => $items]);
	}

	/*
	|--------------------------------------------------------------------------
	| Create the Item List
	|--------------------------------------------------------------------------
	*/
	public function form(){
		$foo = new ItemList;
		return $foo->getForm();
	}


	public function addLineItem($invoice_id, $item_id, $quantity) {
	$invoices =	DB::insert(
			'INSERT INTO invoice_item 
			(invoice_id, item_id, quantity) 
			values (:invoice_id, :item_id, :quantity)',
			[':invoice_id' => $invoice_id,
			':item_id' => $item_id,
			':quantity' => $quantity
			]);
		// $id = DB::getPdo()->lastInsertId();
		// return redirect('singleInvoice/' . $id);

	}



}
