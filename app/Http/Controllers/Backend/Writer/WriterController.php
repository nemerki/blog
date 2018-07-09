<?php

namespace App\Http\Controllers\Backend\Writer;

use App\Writer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WriterController extends Controller
{
    public function index()
    {
        $writers = Writer::orderByDesc("created_at")->get();
        return view("backend.writer.index", compact("writers"));
    }

    public function status(Request $request)
    {
        $id = $request->id;

        if ($request->status == 2) {
            DB::table("role_user")->insert(["user_id" => $id, "role_id" => 2]);
        } else {
            Db::table("role_user")->where("user_id", $id)->where("role_id", 2)->delete();
        }
    }

    public function destroy(Request $request)
    {
        $writer = Writer::where("id", $request->id)->first();
        $writer->delete();

        if ($writer) {

            return ["status" => "success", "title" => "başarılı", "message" => "Silindi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Silinemedi"];
    }
}
