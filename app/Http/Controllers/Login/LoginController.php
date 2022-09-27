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
        $username = $request->input('username');
        $password = $request->input('password');

        $query = RegisterModel::where('username', $username)
            ->where('password', $password)
            ->where(fn (object $query): object => $query->orWhere('role', 'admin'))
            ->get();

        if ($query) {

            if ($this->validationLogin($username, $password)->auth()) {

                return response()->json([
                    'status' => ResponseStatus::OK->value,
                    'username' => $username,
                    'password' => $password
                ]);
            }
        }

        return response()->json([
            'status' => ResponseStatus::SERVER_ERROR->value,
        ]);
    }
    /**
     * @param string $username
     * @param string $password
     * @return object
     */
    public function validationLogin(string $username, string $password): object
    {
        return $this;
    }

    public function auth(): bool
    {
        return true;
    }
}
