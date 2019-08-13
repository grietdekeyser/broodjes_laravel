<?php

namespace App\Http\Controllers;

use App\Sandwich;
use App\SandwichFilling;
use App\SandwichType;
use Illuminate\Http\Request;

class SandwichController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $cart = session('cart');
        foreach ($cart as $sandwich) {
            $sandwich['price'] = $this->getPrice($sandwich);
            $sandwich['user_id'] = auth()->id();
            $sandwich['filling'] = serialize($sandwich['filling']);

            Sandwich::create($sandwich);

            session()->flash('message', 'Je bestelling werd geplaatst.');
        }

        return redirect('/overview');
    }


    /**
     * Converts cart to string
     *
     * @param  $cart
     * @param  $database, true if cart was stored in the database (serialized)
     */
    public function cartToString($cart, $database = false)
    {
        $strCart = [];
        foreach ($cart as $sandwich) {
            if ($database) {
                $sandwich['filling'] = unserialize($sandwich['filling']);
            }
            $strCart[] = $this->sandwichToString($sandwich);
        }
        return $strCart;
    }

    public function sandwichToString($sandwich)
    {
        $type = SandwichType::find($sandwich['type']);
        $strType = $type->name;

        $strFilling = "";
        $fillingId = $sandwich['filling'];
        for ($i = 0; $i < count($fillingId); $i++) {
            $filling = SandwichFilling::find($fillingId[$i]);
            $strFilling .= $filling->name;
            if (count($fillingId) > 1 && $i < count($fillingId)-2) {
                $strFilling .= ", ";
            }
            if (count($fillingId) > 1 && $i == count($fillingId)-2) {
                $strFilling .= " en ";
            }
        }

        if (array_key_exists('price', $sandwich)) {
            $price = $sandwich['price'];
        } else {
            $price = $this->getPrice($sandwich);
        }

        $strSandwich = $strType . " met " . $strFilling . " (€ " . number_format($price, 2) . ")";
        return $strSandwich;
    }

    public function getPrice($sandwich)
    {
        $type = SandwichType::find($sandwich['type']);
        $price = $type->price;

        $fillingId = $sandwich['filling'];
        for ($i = 0; $i < count($fillingId); $i++) {
            $filling = SandwichFilling::find($fillingId[$i]);
            $price += $filling->price;
        }

        return $price;
    }
}
