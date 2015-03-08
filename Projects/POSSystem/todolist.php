
TODO
1. Fix the issets on all pages. And produce an error message.
2. Fix placeholer on invoices. when no invoice items.
3. Cust details doesn't display if no invoices. 
4. Edit customer creates redirect situation (back button doesn't work.)
5. Add invoice duplicate item should be added to existing item. 
6. Add invoice item total column. 


7. Need to add some oop

class ItemModel {
	public function fetchAll() {
		$sql = "";
		foreach ($results as $row) {
			$items[] = $row;
		}
		return $items;
	}	

}

if I were to print_r the items, I would get this: 
[
['id' => 1, 'name' => 'hammer', 'price' => 12],
]

Returns one thing.
$row = $resutls[0];  

If you get it as an array.
foreach(results as row)


while ($row = $statement->fetch()) {
	This makes each row return it to you one at a time. 
}

$row = $statement->fetch(); 
	This one gets the first row. 