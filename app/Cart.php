<?php

namespace App;
use DB;

class Cart 
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart) {
		if($oldCart) {
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id, $qty) {
		$product_price = DB::table('product_prices')->where('product_id',$item->id)->value('price');
		$storedItem = ['qty' =>$qty, 'price' => $product_price, 'item' => $item->id];
		if($this->items) {
			if(array_key_exists($id, $this->items)) {
				$storedItem = $this->items[$id];
			}
		}
		$storedItem['qty'] = $qty;
		$storedItem['price'] = $product_price * $storedItem['qty'];
		$this->items[$id] = $storedItem;
		$this->totalQty += $storedItem['qty'];
		$this->totalPrice += $storedItem['price'];
	}

	public function removeItem($id) {
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
