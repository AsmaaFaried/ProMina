<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=Album::latest()->where('user_id',Auth()->id())->get();
        return view("Albums.index",compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("Albums.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255','min:3'],
        ]);

        $album= Album::create([
            'name'=>$request['name'],
            'user_id'=> Auth::id()


        ]);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $album->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $pictures = $album->getMedia()->count();

        return view('Albums.show', compact('album', 'pictures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $album->update([
            'name' => $request->name
        ]);
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $album=Album::find($request->album_delete_id);
        $result = $album->delete();
        if(!result){
            return redirect()->back()->with(['error'=>'Something wrong happen']);
        }
        return redirect()->back()->with(['success'=>'Album deleted successfully']);

    }


    public function upload(Request $request, Album $album)
    {
        if ($request->has('image')) {
            $album->addMedia($request->image)->toMediaCollection();
        }
        return redirect()->back();
    }
    // public function showImage(Album $album, $id)
    // {
    //     $media = $album->getMedia();
    //     $image = $media->where('id', $id)->first();

    //     return view('albums.image-show', compact('album', 'image'));
    // }

    // public function destroyImage(Album $album, $id)
    // {
    //     $media = $album->getMedia();
    //     $image = $media->where('id', $id)->first();
    //     $image->delete();

    //     return redirect()->back();
    // }

}
