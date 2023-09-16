<?php

namespace App\Http\Actions\albums;

use App\Models\Album;
use Illuminate\Http\Request;

class MoveMediaAction
{
    public function execute(Request $request)
    {
        if($request->ajax()){
            $old_album_id = $request['old_album_id'];
            $new_album_id = $request['new_album_id'];
            $old_album = Album::find($old_album_id);
            $new_album = Album::find($new_album_id);
            $mediaItems = $old_album->getMedia('images');
            foreach ($mediaItems as $item){
                $item->move($new_album , 'images');
            }
            $old_album->delete();
        }
    }
}
