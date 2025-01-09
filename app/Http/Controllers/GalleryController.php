<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::paginate(5);
        return view('image.gallery', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('image.addimage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"=>"required",
            "description"=>"required|max:150",
            "image"=>"required|image|mimes:jpeg,png,jpeg,svg,gif"
        ]);

        $files = $request->file('image');
        $filename = "";
        if(!empty($files) && $files !==""){
            $path = public_path()."/gallery_image/";
            $filename = "gallery_image_".time()."_".$files->getClientOriginalName();
            $moved = $files->move($path,$filename);
        }


        $gallery = Gallery::create([
            "name"=>$validated['name'],
            "description"=>$validated['description'],
            "image"=>$filename
        ]);

        if(!empty($gallery) && $gallery !== ""){
            return redirect()->route('gallery.index')->with("success", "New Image Added Successfully!");
        }else{return redirect()->route('gallery.index')->with("error", "Image not added please try again!");}
      
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);
        return view('image.view',compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('image.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $gallery = Gallery::find($id);
        $validated = $request->validate([
            "name"=>"required",
            "description"=>"required|max:150",
            "image"=>"image|mimes:jpeg,png,jpeg,svg,gif"
        ]);

        $files = $request->file('image');
        $filename = "";
        if(isset($files) && $files !==""){
            $path = public_path()."/gallery_image/";
            if(file_exists($data = $path.$gallery->image)){
                $gallery->image ? unlink($data) : "";
            }
            $filename = "gallery_image_".time()."_".$files->getClientOriginalName();
            $moved = $files->move($path,$filename);
        }

        $isupdated = $gallery->update([
            "name"=>$validated['name'],
            "description"=>$validated['description'],
            "image"=>$filename ? $filename : $gallery->image
        ]);

        if($isupdated){
            return redirect()->route('gallery.index')->with("success", "Image Update Successfully!");
        }else{return redirect()->route('gallery.index')->with("error", "Image not Update please try again!");}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if(isset($gallery)){
            $path = public_path()."/gallery_image/";
            if(file_exists($data = $path.$gallery->image)){
                $gallery->image ? unlink($data) : "";
            }
            $gallery->delete();
            return redirect()->route('gallery.index')->with("success", "Image deleted successfully!");
        }else{return redirect()->route('gallery.index')->with("error", "Image not found!");}
    }
}
