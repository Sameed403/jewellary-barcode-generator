<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faker = Factory::create();
        $barcode = $faker->numberBetween(1000000, 999999999);
        $product_name = $request->product_name;
        $product_quantity = $request->product_quantity;
        $product_netweight = $request->product_netweight;
        $product_size = $request->product_size;
        $product_carrot = $request->product_carrot;
        $product_extra = $request->product_extra;


        if(!session()->get('barcode')){
            $data = array(
                array(
                    'product_barcode_number' => $barcode,
                    'product_name' => $product_name,
                    'product_quantity' => $product_quantity,
                    'product_netweight' => $product_netweight,
                    'product_size' => $product_size,
                    'product_carrot' => $product_carrot,
                    'product_extra' => $product_extra,
                )
            );
            session()->put('barcode', $data);
        }else{
            $data = array(
                'product_barcode_number' => $barcode,
                'product_name' => $product_name,
                'product_quantity' => $product_quantity,
                'product_netweight' => $product_netweight,
                'product_size' => $product_size,
                'product_carrot' => $product_carrot,
                'product_extra' => $product_extra,
            );

            session()->push('barcode', $data);
        }
        return redirect(route('homepage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->flush();
        return redirect(route('homepage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeItem(Request $request)
    {
        $key = $request->key;
        Session::forget('barcode.' . $key);
        return redirect(route('homepage'));
    }
}
