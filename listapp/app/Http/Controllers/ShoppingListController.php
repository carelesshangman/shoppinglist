<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingItem;

class ShoppingListController extends Controller
{
    public function index()
    {
        $items = ShoppingItem::all();
        return view('shopping-list', compact('items'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $item = ShoppingItem::create($request->validate(['name' => 'required']));
        return redirect()->back();
    }

    public function update(Request $request, ShoppingItem $item): \Illuminate\Http\RedirectResponse
    {
        $item->purchased = true;
        $item->save();
        return redirect()->back();
    }

    public function destroy(ShoppingItem $item): \Illuminate\Http\RedirectResponse
    {
        $item->delete();
        return redirect()->back();
    }

}
