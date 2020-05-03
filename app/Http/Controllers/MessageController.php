<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use APP\items;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function submit(Request $request){
        $this->validate($request, [
          'product_name' => 'required',
          'quantity' => 'required',
          'date' => 'required'
        ]);

  
        // Create New Message
        $message = new Product;
        $message->product_name = $request->input('product_name');
        $message->quantity = $request->input('quantity');
        $message->date = $request->input('date');
        $message->user_id = Auth::user()->id;
        // Save Message
        $message->save();
  
        return redirect()->route('items.index')->with('success', 'Product Details Captured');
      }
  
      public function getMessages(){
        $messages = ["one", 'two' ,'three'];
  
        
      return view('messages')->with('messages', $messages);
      
      }
      
}
