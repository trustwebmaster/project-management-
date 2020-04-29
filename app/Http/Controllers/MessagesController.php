<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class MessagesController extends Controller
{
    public function submit(Request $request){
        $this->validate($request, [
          'product_name' => 'required',
          'quantity' => 'required',
          'date' => 'required'
        ]);

  
        // Create New Message
        $message = new Products;
        $message->product_name = $request->input('product_name');
        $message->quantity = $request->input('quantity');
        $message->date = $request->input('date');
        // Save Message
        $message->save();
  
        return redirect()->route('items.index')->with('success', 'Product Details Captured');
      }
  
      public function getMessages(){
        $messages = Products::all();
  
        
      return view('messages')->with('messages', $messages);
      }
      
}
