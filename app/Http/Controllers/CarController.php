<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(([
            'model_name' => 'required',
            'description' => 'required',
            'product_year' => 'required',
            'price' => 'required',
            'manufacturer_id' => 'required'
        ]));

        return Car::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return $car;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate(([
            'model_name' => 'required',
            'description' => 'required',
            'product_year' => 'required',
            'price' => 'required',
            'manufacturer_id' => 'required'
        ]));

        $car->update($request->all());

        return $car;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(['message' => 'Car deleted successfully']);
    }
}
