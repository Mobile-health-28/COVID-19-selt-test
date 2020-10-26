<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @OA\Info(
 *    title="COVID self test application backend",
 *    version="1.0.0",
 * )
 */
class ApiAuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/register",
     * summary="Create account for new user",
     * description="Create new account ",
     * operationId="authRegister",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user payload",
     *    @OA\JsonContent(
     *       required={"email","password", "phone"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="phone", type="string", example="22996242162"),
     *      @OA\Property(property="name", type="string", example="firmin Banignate"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Bad request",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry but it seems like data are not correct, check sended data and retry again please")
     *        )
     *     )
     * )
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:8|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => str_limit($token, 100, '')];
        return response($response, 200);
    }

    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    $user['api_token'] = str_limit($token, 100, '');
                    $user->update();
                    $response = ['token' => str_limit($token, 100, '')];
                    if (Auth::check()) {
                        return response($response, 200);
                    } else
                        return response('Login failed', 500);
                } else
                    return response('Login failed', 500);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }

    /**
     * @OA\Post(
     * path="/api/logout",
     * summary="Sign out",
     * description="Log out connected user",
     * operationId="authLogout",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Log  the user out",
     *    @OA\JsonContent(
     *       required={"user_id"},
     *     @OA\Property(property="user_id", type="string")
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="No user founded",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User not found")
     *        )
     *     )
     * )
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function logout(Request $request)
    {
        $token = str_limit(explode(' ', $request->header('Authorization'))[1], 100,'');
        $validApi = Auth::guard('api')->validate(['api_token' => $token]);
        if($validApi) {
            $user = User::where(['api_token' => $token])->firstOrFail();
            $user['api_token'] = null;
            $user->update();
            $response = ['message' => 'You have been successfully logged out!'];
            return response($response, 200);
        } else {
            return response(["message" => "Not logged in"], 200);
        }
    }
}
