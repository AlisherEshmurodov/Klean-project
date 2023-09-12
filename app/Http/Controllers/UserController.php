<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Termwind\ValueObjects\pr;

class UserController extends Controller
{
    public function index()
    {
//        return response("BU userlarni royxati res", 204);
//        return redirect("/users/create");
        return response()->json([
            "yowi"=>22,
            "jinsi"=>'erkak'
        ]);
    }

    /* public function create($user_id)
     {
         return view("users.create", ['yuser' => $user_id]);
     }*/

    public function create()
    {
        return view("users.create");
    }

    public function store(Request $request)
    {
//       return dd($request->input('emaile'));
        return dd($request->ismi);
    }

    public function show($user)
    {
        return "tanlangan user: " . $user;
    }
}
