<?php

namespace App\Http\Controllers;

use App\SandwichFilling;
use App\SandwichType;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        //TESTING
        //session()->forget('cart');

        return view('home');
    }

    public function order()
    {   
        if (auth()->user()->sandwiches->count()) {
            return redirect('/overview');
        } elseif (date("H") > 9) {
            return view('toolate');
        } else {
            if(session('cart')) {
                $sandwichCtr = new SandwichController;
                $cart = $sandwichCtr->cartToString(session('cart'));
            } else {
                $cart = null;
            }
            return view('order', [
                'sandwichTypes' => SandwichType::all(),
                'sandwichFillings' => SandwichFilling::all(),
                'cart' => $cart
            ]);
        }
    }

    public function overview()
    {   
        $ordered = auth()->user()->sandwiches;

        if($ordered->count()) {
            $sandwichCtr = new SandwichController;
            $cart = $sandwichCtr->cartToString($ordered, true);
            return view('overview', [
                'cart' => $cart
            ]);
        } else {
            return redirect('/order');
        }
    }

    /**
     * Stores the orders in a session(cart).
     *
     * @return redirect
     */
    public function store()
    {
        if (session('cart')) {
            $sandwiches = session('cart');

        } else {
            $sandwiches = [];
        } 

        $sandwiches[] = $this->validateCart();

        session(['cart' => $sandwiches]);

        return redirect('/order');
    }

    public function validateCart()
    {
        $rules = [
            'type' => ['required', 'numeric', 'exists:sandwich_types,id'],
            'filling' => ['required', 'array'],
            'filling.*' => ['numeric', 'exists:sandwich_fillings,id']
        ];

        $messages = [
            'type.required' => 'Kies het type broodje',
            'filling.required' => 'Kies minstens één soort beleg',
            'filling.array' => 'Er gaat iets fout, probeer later opnieuw',
            'filling.*' => 'Er gaat iets fout, probeer later opnieuw',
            'type.*' => 'Er gaat iets fout, probeer later opnieuw'
        ];

        return $this->validate(request(), $rules, $messages);
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect ('/order');
    }
}
