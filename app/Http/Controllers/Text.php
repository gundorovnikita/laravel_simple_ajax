<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class text extends Controller
{
    public function index(){
    	$text = \App\Text::all();
    	return view('index', [
    		'text'=>$text,
    	]);
    }
    public function send(Request $request){
    	$message = new \App\Text();
    	$message->text = $request->message;
    	$message->save();
    	return response()->json(['succes'=>'yes']);
    }
    public function delete(Request $request){
    	$text = \App\Text::find($request->id);
    	$text->delete();
    	return response()->json(['succes'=>'yes']);
    }
    public function cart(){
        return view('cart');
    }
    public function addToCart($id)
    {
        $text = \App\Text::find($id);
 
        if(!$text) {
 
            abort(404);
 
        }
 
        $cart = session()->get('cart');
 
        // if cart is empty then this the first text
        if(!$cart) {
 
            $cart = [
                    $id => [
                        "name" => $text->text,
                        "quantity" => 1,
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'text added to cart successfully!');
        }
 
        // if cart not empty then check if this text exist then increment quantity
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'text added to cart successfully!');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $text->text,
            "quantity" => 1,
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'text added to cart successfully!');
    }
    
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }



    public function api(){
        $text = \App\Text::all();
        return $text->toArray();
    }
    public function parse(){


        return view('parse');
    }
}
