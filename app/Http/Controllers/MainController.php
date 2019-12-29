<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = [];

        if ($user) {
            $data['id'] = $user->getKey();
            $data['name'] = $user->name;
        }

        return view('main', [
            'data' => $data
        ]);
    }
}
