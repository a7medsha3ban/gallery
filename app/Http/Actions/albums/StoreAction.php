<?php

namespace App\Http\Actions\albums;

use App\Models\Album;
use Illuminate\Http\Request;

class StoreAction
{
    public function execute(Request $request)
    {
        if(isset($request['submit'])){
            $album= Album::create([
                'name'=>$request['name']
            ]);
            if($request->hasFile('images')){
                foreach ($request['images'] as $image){
                    $album->addMedia($image)->toMediaCollection('images');
                }
            }
        }
    }
}
