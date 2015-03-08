<?php namespace App\Http\Controllers;

use Request;
use DB;

class InvoiceController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Creating New Invoices
	|--------------------------------------------------------------------------
	*/
	public function addInvoice($customer_id) {
	
		$invoices =	DB::insert(
			'INSERT INTO invoice 
			(customer_id, created_at) 
			values (:customer_id, NOW())',
			[':customer_id' => $customer_id]);
		$id = DB::getPdo()->lastInsertId();
		return redirect('singleInvoice/' . $id);
	}



	/*
	|--------------------------------------------------------------------------
	| Reading/Displaying Invoices
	|--------------------------------------------------------------------------
	*/
	/**
	 * Show all the invoices to the user.
	 */
	public function all() {
		$invoices = DB::select(
			'SELECT invoice_id, first_name, last_name,  
				customer_id, sum(price*quantity) AS total
			FROM invoice
			LEFT JOIN customer USING (customer_id)
			LEFT JOIN invoice_item USING (invoice_id)
			LEFT JOIN item USING (item_id)
			GROUP BY invoice_id');
		return view("/invoice", ["invoices"=>$invoices]);
	}

	/**
	 * Show just one invoice to the user.
	 */
	public function justOne($invoice_id) {
		$results = DB::select(
		'Select invoice_id, quantity, name, price, item_id,
		(price*quantity) as lineTotal 
		from invoice
		Join invoice_item using (invoice_id)
		Join item using (item_id)
		where invoice_id = :id',
		[':id' => $invoice_id]);


		$items = DB::select(
		'select * from item');

		$tableTotal = 0;
		foreach($results as $item) {
			$tableTotal += $item->lineTotal;
		}

		return view('singleInvoice', 
			['invoices' => $results,
			'invoice_id' => $invoice_id,
			'tableTotal' => $tableTotal,
			'items' => $items]);
	}


	/*
	|--------------------------------------------------------------------------
	| Updating Invoices and Their Contents
	|--------------------------------------------------------------------------
	*/
	public function editInvoice($invoice_id){
		$quantity = Request::input('quantity');
		$item_id = Request::input('item_id');
		
		$results = DB::delete(
			'DELETE FROM invoice_item
			WHERE invoice_id = :invoice_id
			AND item_id = :item_id',
			['invoice_id' => $invoice_id,
			'item_id' => $item_id]
			);

		$invoices =	DB::insert(
			'INSERT INTO invoice_item 
			(invoice_id, item_id, quantity) 
			values (:invoice_id, :item_id, :quantity)',
			[':invoice_id' => $invoice_id,
			':item_id' => $item_id,
			':quantity' => $quantity
			]);

		return redirect()->back()->withInput(['invoice_id', $invoice_id]);
	}


	/*
	|--------------------------------------------------------------------------
	| Deleting Invoices and Their Contents
	|--------------------------------------------------------------------------
	*/
	/**
	 * Remove a line item from an invoice.
	 */
	public function removeLineItem($invoice_id, $item_id) {
		$results = DB::delete(
			'DELETE FROM invoice_item
			WHERE invoice_id = :invoice_id
			AND item_id = :item_id',
			['invoice_id' => $invoice_id,
			'item_id' => $item_id]
			);
		return redirect()->back()->withInput(['invoice_id', $invoice_id]);
	}

	/**
	 * Remove an entire invoice.
	 */
	public function removeInvoice($invoice_id) {
		$results = DB::delete(
			'DELETE FROM invoice
			WHERE invoice_id = :invoice_id',
			['invoice_id' => $invoice_id]
			);
		return redirect()->back();
	}




// Should be: Using a model called invoice. 
	//public function all(){
		// $results = Invoice::all();
		// return view(.... )
// }
// In the model: 
// Class invoice {
//		protected static $table = 'invoice';
//		protected static $primary_key = 'id';
//	
//		public function all(){
	// 		$invoice = new Invoice(5); 
// 		} 
// }
// Make a class Invoice, 
//
// 



}
