<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $user = User::inRandomOrder()->first();
        return response([
            'id'    => $user->id
        ], Response::HTTP_ACCEPTED);
    }
}
