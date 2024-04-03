<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingItem;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Log;

class ShoppingItemController extends Controller
{
    public function store(Request $request, $listId)
    {
        Log::debug("Incoming Request Dataaaaaaaaa: ", $request->all());
        $request->validate(['name' => 'required']);


        $list = ShoppingList::findOrFail($listId);

        $item = ShoppingItem::create([
            'name' => $request->name,
            'list_id' => $list->id,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $listId, ShoppingItem $item)
    {
        if ($item->list_id !== $listId) {
            abort(404);
        }

        $item->update($request->all());

        $item->save();

        return redirect()->back();
    }


    public function destroy($listId, ShoppingItem $item)
    {

        if ($item->list_id !== $listId) {
            abort(404);
        }

        $item->delete();
        return redirect()->back();
    }
    public function updateQuantity(Request $request, ShoppingItem $item)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $item->quantity = $request->quantity;
        $item->save();

        return redirect()->back()->with('success', 'Quantity updated!');
    }
}
