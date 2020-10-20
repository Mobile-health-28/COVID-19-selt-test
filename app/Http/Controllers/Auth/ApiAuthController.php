<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
 */
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:8|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
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
 *       @OA\Property(property="email", type="string", format="email", example="firminapp@gmail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="passepasse"),
 *
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
 */
    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token,'user'=> $user];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

/**
 * @OA\Get(
 * path="/api/user/{id}",
 * summary="Get user infos",
 * description="Get user's infos",
 * operationId="userDetail",
 * tags={"auth"},
 * security={ {"bearer": {} }},
 * @OA\Parameter(
 *    description="User's Id",
 *    in="path",
 *    name="id",
 *    required=true,
 *    example="1",
 *    @OA\Schema(
 *       type="integer",
 *       format="int64"
 *    )
 * ),
 * * @OA\Response(
 *    response=422,
 *    description="No User founded",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="User not founded")
 *        )
 *     )
 * )
 */
public function getByToken (Request $request,$id) {
   

    $user = User::find($id);
    if ($user) {
        return $user;
    } else {
        $response = ["message" =>'User does not exist'];
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
 *    ),
 * ),
 * @OA\Response(
 *    response=404,
 *    description="No user founded",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="User not found")
 *        )
 *     )
 * )
 */
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
  /**
 * @OA\Get(
 * path="/api/users",
 * summary="Get all users",
 * description="Get all users",
 * operationId="userGetAll",
 * tags={"auth"},
 * security={ {"bearer": {} }},
 * * @OA\Response(
 *    response=422,
 *    description="No User founded",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Users not founded")
 *        )
 *     )
 * )
 */

    public function getUsers(){
        return User::all();
    }
}
