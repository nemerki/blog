<?php

namespace App\Http\Controllers\Backend\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("backend.category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("backend.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create([
            "tittle" => $request->tittle
        ]);
        if ($image = $request->file("image")) {
            $image_name = time() . $image->getClientOriginalName();
            $thumb = "thumb_" . time() . $image->getClientOriginalName();

            Image::make($image->getRealPath())->fit(1900, 872)->fill([0, 0, 0, .5])->save("uploads/" . $image_name);
            Image::make($image->getRealPath())->fit(600, 400)->save("uploads/" . $thumb);
            $image_path = "uploads/" . $image_name;

            $input = [];
            $input["name"] = $image_path;
            $input["imageable_id"] = $category->id;
            $input["imageable_type"] = "App\Category";

            \App\Image::create($input);
        }

        if ($category) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kategori Eklendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kategori Eklenemedi"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where("id", $id)->firstOrFail();
        return view("backend.category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $category = Category::find($id);
        $category->update([
            "tittle" => $request->tittle
        ]);

        if ($image = $request->file("image")) {
            $image_name = substr($category->image->name, 8);
            $thumb = "thumb_" . $image_name;

            Image::make($image->getRealPath())->fit(1900, 872)->fill([0, 0, 0, .5])->save("uploads/" . $image_name);
            Image::make($image->getRealPath())->fit(600, 400)->save("uploads/" . $thumb);


        }

        if ($category) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kategori Güncellendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kategori Güncellenemedi"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $category_img = Category::find($id)->image->name;
        $thumb = substr($category_img, 8);

        unlink(public_path($category_img));
        unlink(public_path("uploads/thumb_" . $thumb));

        $image = \App\Image::where("imageable_id", $id)->where("imageable_type", "App\Category")->delete();

        $category = Category::destroy($id);

        if ($category && $image) {

            return ["status" => "success", "title" => "başarılı", "message" => "Ürün  Silindi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Ürün  Silinemedi"];
    }
}
