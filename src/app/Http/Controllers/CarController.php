<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;

class CarController extends Controller
{
    //

    public function index()
    {
        $car = Car::all();

         return response()->json($car);

    }

    public function store(CarRequest $request)
    {
        $data = $request->validated();
        $car = Car::create($data);
        
        return response()->json($car);
    }


        public function delete(Car $clint, $id)
    {

        $clint->find($id)->delete();
        
        return response()->json([],200);
    }

    public function update(CarRequest $request, $id )
    
    {
        $data = $request->validated();
        $clint = Car::findOrfail($id);
        
        $clint->update($data);

        return response()->json($data);
    }

}
