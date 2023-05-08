<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;



class CommonController extends Controller
{
    public function AdminList()
    {
        $savedadmins = User::orderBy('id','asc')->get();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Ana Sayfa"], ['name' => "Yöneticiler"]
        ];
        return view('/content/Admin/list', compact('savedadmins'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function newAdmin(Request $request)
    {
        $hashpassword = password_hash($request->password, PASSWORD_DEFAULT);
        $rememberToken = Str::random(60);

        $savenewquestion = new User();
        $savenewquestion->name = $request->name;
        $savenewquestion->email = $request->email;
        $savenewquestion->password = $hashpassword;
        $savenewquestion->remember_token = $rememberToken;

        $savenewquestion->save();


        return back();
    }


    public function editAdmin(Request $request, $id)
    {
        $edituser = User::findOrFail($id);


        $hashpassword = password_hash($request->password, PASSWORD_DEFAULT);


        $edituser->name = $request->name;
        $edituser->email = $request->email;
        $edituser->password = $hashpassword;

        if ($request->has('name') && $request->name != "") {
            $edituser->name = $request->name;
        }

        if ($request->has('email') && $request->email != "") {
            $edituser->email = $request->email;
        }

        if ($request->has('password') && $request->password != "") {
            $hashpassword = password_hash($request->password, PASSWORD_DEFAULT);
            $edituser->password = $hashpassword;
        }

        $edituser->save();


        return back();
    }
}
