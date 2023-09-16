<?php

namespace App\Http\Actions\albums;

use App\Models\Album;
use Illuminate\Http\Request;

class DeleteMediaAction
{
    public function execute(Request $request)
    {
        if($request->ajax()){
            $album_id = $request['album_id'];
            $media_id = $request['media_id'];
            $album = Album::find($album_id);
            $mediaItem = $album->getMedia('images')
                ->where('id', $media_id) // filter all items from collection with this condition
                ->first();
            $mediaItem->delete();
        }

    }
}
