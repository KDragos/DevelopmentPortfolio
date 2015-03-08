<?php 

namespace App\Library;
use DB;

class ItemList {

	public function getForm(){
		$form = '<select>';
		$results = DB::select(
		'Select *
		from item');
		foreach($results as $result) {
			$form .= "<option value=\"{{$result->item_id}}\">{{$result->name}}</option>";
		}
		$form .= "</select>";
		return $form;
	}


}


?>