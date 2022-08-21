<?php

namespace App\Http\Resources;

use App\Http\Resources\ClintResource;
use App\Http\Resources\ClintResourceCollection;
use Illuminate\Support\Facades\Storage;

use App\Models\Clint;



use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'brand'=>$this->brand,
            'vin_code'=>$this->vin_code,
            'problem'=>$this->problem,
            'license_plate'=>$this->license_plate,
            'image_path'=>Storage::url($this->image),
            'clint_id'=>$this->clint_id,
            'clint'=>$this->clint

        ];
    }
}
