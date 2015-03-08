<?php 
require_once('initialize.php'); // Remember to take this out. 


class ItemModel {

	public function getAll() {
		$sql = "
		SELECT * 
		FROM item
		";
	
		$statement = DB::prepare($sql);
		DB::execute($statement);

		$results = $statement->fetchAll();
		$items = [];

		foreach ($results as $key => $row) {
			$items[$key] = $row;
		}
		return $items;
	}

}


?>