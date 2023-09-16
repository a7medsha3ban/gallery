<?php

namespace App\Http\Actions\albums;

use App\Models\Album;
use Illuminate\Http\Request;

class DeleteAction
{
    public function execute(Request $request)
    {
        if($request->ajax()){
            $id = $request['id'];
            $album = Album::find($id);
            $album->delete();
        }
    }
}
