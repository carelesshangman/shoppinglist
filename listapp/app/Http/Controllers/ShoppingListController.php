<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;
use App\Models\ShoppingItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ShoppingListController extends Controller
{
    public function index()
    {
        $items = ["aaaa","aaaa"];
//        dd($items);

        return view('shopping-list', compact('items'));
    }







    public function store(Request $request)
    {
        Log::debug("Incoming Request Data: ", $request->all());
//        $request->validate([
//            'name' => 'required',
//            'share_code' => 'required|exists:shopping_lists,share_code'
//        ]);
//
//        $list = ShoppingList::where('share_code', $request->share_code)->firstOrFail();
//        $item = ShoppingItem::create([
//            'name' => $request->name,
//            'list_id' => $request->list_id, // Keep using the list_id column
//        ]);
        $item = ShoppingItem::create($request->validate([
            'name' => 'required', // Expect a string for 'name'
            'list_id' => 'required', // Expect an integer for 'list_id'
        ]));
        Log::debug($item);
        return redirect()->back();
    }



    public function update(Request $request, ShoppingItem $item): \Illuminate\Http\RedirectResponse
    {
        if($item->purchased == true){
            $item->purchased = false;
        }
        else{
            $item->purchased = true;
        }
        $item->save();
        return redirect()->back();
    }

    public function destroy(ShoppingItem $item): \Illuminate\Http\RedirectResponse
    {
        $item->delete();
        return redirect()->back();
    }

    public function getItems()
    {
        $items = ShoppingItem::all();
        return response()->json($items);
    }

    public function create(Request $request)
    {
        // Generate unique share code
        $shareCode = $this->generateUniqueCode();

        $list = ShoppingList::create([
            'owner' => Auth::user()->email,
            'share_code' => $shareCode,
        ]);

        return response()->json(['list_id' => $list->id, 'share_code' => $shareCode]);
    }

    private function generateUniqueCode()
    {
        do {
            $code = Str::random(4); // Generate random 4-character string
        } while (ShoppingList::where('share_code', $code)->exists()); // Check uniqueness
        Log::debug("Generated: $code");
        return $code;
    }

    public function show($listId)
    {
        Log::debug("test");
        $list = ShoppingList::with('items')->findOrFail($listId);
        return view('lists.show', compact('list'));
    }

    public function showByShareCode($shareCode)
    {
        $list = ShoppingList::where('share_code', $shareCode)->firstOrFail();
        $items = ShoppingItem::where('list_id', $shareCode)->get();

        return view('shopping-list', compact('items', 'list'));
    }

    public function deleteList(Request $request, ShoppingList $list)
    {
        // Authorization: Ensure the current user owns the list

        $list->owner = 'doesnt@exist.true';
        $list->save();

        // Decide if you want to redirect:
        return redirect('/')->with('success', 'List Removed');  // Or wherever you want
    }
}
