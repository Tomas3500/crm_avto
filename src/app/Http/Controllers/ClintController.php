<?php

namespace App\Http\Controllers;
use App\Models\Clint;
use App\Http\Requests\ClintRequest;
use App\Http\Resources\ClintResource;
use App\Http\Resources\ClintResourceCollection;


use Illuminate\Http\Request;

class ClintController extends Controller
{
    //

    public function index()
    {


        // dd(new ClintResource(Clint::first()));

        return new ClintResourceCollection(Clint::all());


    }

    public function store(ClintRequest $request)
    {
        $data = $request->validated();
        $clint = Clint::create($data);
        
        return response()->json($clint);
    }


        public function delete(Clint $clint, $id)
    {

        $clint->find($id)->delete();
        return response()->json([],200);
    }

    public function update(ClintRequest $request, $id )
    
    {
        $data = $request->validated();
        $clint = Clint::findOrfail($id);
        
        $clint->update($data);

        return response()->json($data);
    }


}
