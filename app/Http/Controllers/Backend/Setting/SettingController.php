<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        return view("backend.setting.index", compact("settings"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            "tittle" => "required",
            "descripton" => "required",
            "author" => "required",
            "keywords" => "required",
            "facebook" => "required",
            "twitter" => "required",
            "github" => "required",
        ]);
        $setting = Setting::where("name", "tittle")->update(["value" => $request->tittle]);
        $setting = Setting::where("name", "descripton")->update(["value" => $request->descripton]);
        $setting = Setting::where("name", "author")->update(["value" => $request->author]);
        $setting = Setting::where("name", "keywords")->update(["value" => $request->keywords]);
        $setting = Setting::where("name", "facebook")->update(["value" => $request->facebook]);
        $setting = Setting::where("name", "twitter")->update(["value" => $request->twitter]);
        $setting = Setting::where("name", "github")->update(["value" => $request->github]);


        if ($setting) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kategori  Güncellendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kategori Güncellenemedi"];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
