<?php

namespace App\Http\Controllers\Backend\User;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("backend.user.index", compact("users"));
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

        $user = User::where("id", $id)->firstOrFail();
        $allroles = Role::all();
        $roles = $user->roles()->pluck('role_id');
        return view("backend.user.edit", compact("user", "allroles", "roles"));
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
            "name" => "required|max:255",
            "email" => "required|email|unique:users,email," . $id,
            "password" => !empty($request->password) ? "required|min:6" : ""
        ]);
        $user = User::where('id', $id)->firstOrFail();
        $data = request()->only('name', 'email');
        if (request()->filled('password')) {

            if ($request->password != $request->password_confirmation) {
                return ["status" => "error", "title" => "Hatalı", "message" => "Şifreler Eşleşmiyor"];
            } else {
                $data['password'] = Hash::make($request->password);
            }

        }
        $user->update($data);

        $roles = request("role");

        $user->roles()->sync($roles);

        if ($user) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kullanıcı  Güncellendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kullanıcı  Güncellenemedi"];


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::where("id", $request->id)->delete();
        if ($user) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kullanıcı  Silindi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kullanıcı  Silinemedi"];


    }
}
