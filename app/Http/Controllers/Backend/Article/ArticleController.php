<?php

namespace App\Http\Controllers\Backend\Article;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view("backend.article.index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        return view("backend.article.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required|max:255",
            "content" => "required",
            "category_id" => "required",
            "image" => "required|image|mimes:jpg,jpeg,png|max:2048"
        ]);


        $article = Article::create([
            "title" => $request->title,
            "category_id" => $request->category_id,
            "user_id" => Auth::user()->id,
            "status" => 0,
            "content" => $request->get('content'),

        ]);

        if ($image = $request->file("image")) {
            $image_name = time() . $image->getClientOriginalName();
            $thumb = "thumb_" . time() . $image->getClientOriginalName();

            Image::make($image->getRealPath())->fit(1900, 872)->fill([0, 0, 0, .5])->save("uploads/" . $image_name);
            Image::make($image->getRealPath())->fit(600, 400)->save("uploads/" . $thumb);
            $image_path = "uploads/" . $image_name;

            $input = [];
            $input["name"] = $image_path;
            $input["imageable_id"] = $article->id;
            $input["imageable_type"] = "App\Article";

            \App\Image::create($input);
        }

        if ($article) {

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
        $categories = Category::all();
        $article = Article::where("id", $id)->firstOrFail();
        return view("backend.article.edit", compact("article", "categories"));

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
        $this->validate($request, [
            "title" => "required|max:255",
            "content" => "required",
            "category_id" => "required",
        ]);

        $article = Article::where("id", $id)->firstOrFail();
        $article->update([
            "title" => $request->title,
            "category_id" => $request->category_id,
            "content" => $request->get('content'),

        ]);

        if ($image = $request->file("image")) {
            $image_name = substr($article->image->name, 8);
            $thumb = "thumb_" . $image_name;


            Image::make($image->getRealPath())->fit(1900, 872)->fill([0, 0, 0, .5])->save("uploads/" . $image_name);
            Image::make($image->getRealPath())->fit(600, 400)->save("uploads/" . $thumb);

        }

        if ($article) {

            return ["status" => "success", "title" => "başarılı", "message" => "Makale Güncellendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Makale Güncellenemedi"];
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
        $article = Article::find($id);
        $article_img = $article->image->name;
        $thumb = substr($article_img, 8);

        unlink(public_path($article_img));
        unlink(public_path("uploads/thumb_" . $thumb));

        $image = \App\Image::where("imageable_id", $id)->where("imageable_type", "App\Article")->delete();

        $article = Article::destroy($id);

        if ($article && $image) {

            return ["status" => "success", "title" => "başarılı", "message" => "Makalr  Silindi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Makalr  Silinemedi"];
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $s = $request->status;
        $status = Article::where("id", $id)->first();
        $status->status = $s;
        $status->save();

        if ($status) {

            return ["status" => "success", "title" => "başarılı", "message" => "İşlem Başarılı"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "İşlem Başarısız"];
    }
}
