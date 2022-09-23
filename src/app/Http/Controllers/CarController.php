<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Clint;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Resources\CarResource;
use App\Http\Resources\CarResourceCollection;


class CarController extends Controller
{
    //

    public function index()
    {

        return new CarResourceCollection(Car::all());
    }

    public function store(CarRequest $request)
    {

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $typeFile = $request->file('image')->getMimeType();
            if ($typeFile == 'text/plain' || $typeFile == 'application/pdf' || $data['image'] == null) {
                $data['image'] = 'image/blockImage.png';
                Car::create($data);
            } else {
                $fileName = $request->file('image')->hashName();
                $image = Image::make($request->file('image'));
                $image->resize(200, 200);
                $data['image'] = 'image/' . $fileName;
                $image->save(storage_path('app/public/image/') . $fileName);
            }
        } else {
            $data['image'] = 'image/blockImage.png';
            Car::create($data);
        }

        return response()->json($data);
    }



    public function delete(Car $car)

    {

        Storage::disk('public')->delete($car->image);
        $car->find($car->id)->delete();

        return response()->json(['delete'], 200);
    }


    public function update(CarRequest $request, $id)

    {
        $data = $request->validated();
        $clint = Car::findOrfail($id);

        $clint->update($data);

        return response()->json($data);
    }
}
