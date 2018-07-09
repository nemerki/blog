<?php

namespace App\Http\Controllers\Frontend\Writer;

use App\Writer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WriterController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        if(Writer::where("user_id",Auth::user()->id)->count()){
            Session::flash("status",3);
            return redirect("/");
        }
        return view("frontend.writer.index");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "description" => "required",
        ]);
        $input = $request->all();
        $input["user_id"]=Auth::user()->id;
        $write = Writer::create($input);

        if ($write) {

            return ["status" => "success", "title" => "başarılı", "message" => "Başvurunuz Alındı"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "İşlem Başarısız"];
    }
}
