<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CarController extends Controller
{
    //

    public function index()
    {
        
        $car = Car::with('clint')->get();
        return response()->json($car);

    }

    public function store(CarRequest $request)
    {   

        $data = $request->validated();
        $fileNmae = $request->file('image')->getClientOriginalName();

        $image = Image::make($request->file('image'));
        $image->resize(200,200);

        $image->save( public_path('storage/image/').$fileNmae);

        $data['image'] = 'storage/image/'.$fileNmae;
        Car::create($data);

        return response()->json($data);

        
    }


        public function delete(Car $car, $id)
    {

        $car->find($id)->delete();
        
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
