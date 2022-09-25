<?php

namespace App\Http\Controllers\Login;

use App\Enum\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Models\Register\RegisterModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return object
     */
    public function login(Request $request): object
    {
        $username = htmlspecialchars(strip_tags($request->username));
        $password = htmlspecialchars(strip_tags($request->password));

        $queryLogin = RegisterModel::where('username', $username)
            ->where('password', $password)
            ->where(fn (object $query): object => $query->orWhere('role', 'admin'))
            ->get();

        if ($queryLogin) {

            return response()->json([
                'status' => ResponseStatus::OK->value,
                'username' => $username,
                'password' => $password
            ]);
        }

        return response()->json([
            'status' => ResponseStatus::SERVER_ERROR->value,
        ]);
    }
}
