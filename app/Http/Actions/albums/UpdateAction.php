<?php

namespace App\Http\Actions\albums;

use App\Models\Album;
use Illuminate\Http\Request;

class UpdateAction
{
    public function execute(Request $request , $album)
    {
        if(isset($request['submit'])){
            $album->update([
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
