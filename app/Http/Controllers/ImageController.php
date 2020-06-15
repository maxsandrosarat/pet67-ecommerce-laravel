<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $images = Image::all();
        return view('cadastros.images',compact('images'));
    }

    public function store(Request $request)
    {
        $image = new Image();
        $image->nome = $request->input('nome');
        if($request->file('foto')!=""){
            $path = $request->file('foto')->store('images','public');
            $image->foto = $path;
        }
        $image->save();
        return back();
    }

    public function update(Request $request, $id)
    {
        $image = Image::find($id);
        if($request->file('foto')!=""){
            Storage::disk('public')->delete($image->foto);
            $path = $request->file('foto')->store('images','public');
            $image->foto = $path;
        }
        $image->save();
        return back();
    }

    public function destroy($id)
    {
        $image = Image::find($id);
        if(isset($image)){
            Storage::disk('public')->delete($image->foto);
            $image->delete();
        }
        return back();
    }
}
