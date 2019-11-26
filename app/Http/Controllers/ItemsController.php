<?php

namespace App\Http\Controllers;
use DB;
use App\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
    	$items = Items::all();
        $categories = DB::table('categories')->get();
    	return view('items.index', compact('categories'))->with('items', $items);
    }
    public function store()
    {
        request()->validate([
            'name' => 'required', 
            'quantity' => 'required',
            'category' => 'required',   
        ]);
        
    	$items= new Items;
    	$items->name = request()->name;
        $items->quantity = request()->quantity;
        $items->category = request()->category;
    	$items->save();
    	return $items;
    }
    public function update(Items $item)
    {
        $items->name = request()->name;
        $items->quantity = request()->quantity;
        $items->category = request()->category;
        $items->save();
        return $items;
    }
    public function destroy($id) {
      DB::delete('delete from items where id = ?',[$id]);
      return redirect('/items');
   }
}
