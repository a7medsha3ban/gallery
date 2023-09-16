<?php

namespace App\Http\Controllers;

use App\Http\Actions\albums\DeleteAction;
use App\Http\Actions\albums\DeleteMediaAction;
use App\Http\Actions\albums\MoveMediaAction;
use App\Http\Actions\albums\StoreAction;
use App\Http\Actions\albums\UpdateAction;
use App\Http\Requests\albums\StoreAlbumRequest;
use App\Http\Requests\albums\UpdateAlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index(){
        $albums = Album::all();
        return view('albums.index',['albums'=>$albums]);

    }

    public function create(){
        return view('albums.create');

    }

    public function store(StoreAlbumRequest $request,StoreAction $action){
        DB::beginTransaction();
        try {
            $action->execute($request);
            DB::commit();
            return redirect()->route('album.index')->with('success','Album Created Successfully');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('album.index')->with('error','Album Creation Failed');
        }
    }
    public function edit(Album $album){
        return view('albums.edit',['album'=>$album]);

    }
    public function update(UpdateAlbumRequest$request , Album $album , UpdateAction $action){
        DB::beginTransaction();
        try {
            $action->execute($request,$album);
            DB::commit();
            return redirect()->route('album.index')->with('success','Album Updated Successfully');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('album.index')->with('error','Album Update Failed');
        }
    }

    public function delete(Request $request,DeleteAction $action){
        DB::beginTransaction();
        try {
            $action->execute($request);
            DB::commit();
            return response()->json();
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json();
        }
    }
    public function showMedia(Album $album){
        $images = $album->media()->where('collection_name', 'images')->simplePaginate(5);
        return view('albums.media-show',['images'=>$images , 'album'=>$album]);
    }
    public function deleteMedia(Request $request,DeleteMediaAction $action){
        DB::beginTransaction();
        try {
            $action->execute($request);
            DB::commit();
            return response()->json();
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json();
        }
    }
    public function moveMedia(Request $request,MoveMediaAction $action){
        DB::beginTransaction();
        try {
            $action->execute($request);
            DB::commit();
            return response()->json();
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json();
        }
    }
}
