<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\CarRequest;

class CarController extends Controller
{
    //

    public function index()
    {
        $clints = Car::all();

         return response()->json($clints);

    }

    public function store(CarRequest $request)
    {
        $data = $request->validated();
        $clint = Car::create($data);
        
        return response()->json($clint);
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
