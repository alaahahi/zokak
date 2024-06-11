<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginRequestMobile;
use App\Http\Requests\RegisterRequestMobile;
use App\Http\Requests\loginCheckRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\AuthRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;
use JWTAuth;

class AuthController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Auth related functionalities.
     *
     * @var AuthRepository
     */
    public $authRepository;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthRepository $ar)
    {
        $this->middleware('auth:api', ['except' => ['login','loginCheck','reSend','loginMobile', 'register','registerMobile','loginUpdateLocation','changePassword']]);
        $this->authRepository = $ar;

    }

    /**
     * @OA\POST(
     *     path="/api/auth/login",
     *     tags={"Authentication"},
     *     summary="Login",
     *     description="Login",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", example="admin@example.com"),
     *              @OA\Property(property="password", type="string", example="123456")
     *          ),
     *      ),
     *      @OA\Response(response=200, description="Login"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            if ($token = JWTAuth::attempt($credentials)) {
                $data =  $this->respondWithToken($token);
            } else {
                return $this->responseError([ 'Wrong email or password'], 'Wrong email or password', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($data, 'Logged In Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function loginMobile(LoginRequestMobile $request): JsonResponse
    {
        try {
            $phone = $request->only('phone');
            $user = $this->authRepository->sendcode($phone);
            if ($user) {
            return $this->responseSuccess(  $user,'Code send Successfully !');
            }else{
                return $this->responseError('Wrong email or password');
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function registerMobile(RegisterRequestMobile $request): JsonResponse
    {
        try {
            $data = $request->only('phone','email','name','password');
            $user = $this->authRepository->sendcodeFirst($data);
            if ($user) {
            return $this->responseSuccess( $user,'Code send Successfully !');
            }else{
                return $this->responseError('Wrong email or password');
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function loginCheck(loginCheckRequest  $request): JsonResponse
    { 
        try {
            $requestData = $request->only('code','email','password');
            $user =  $this->authRepository->loginCheck($requestData);
            if ($user) {
                if ($token = JWTAuth::fromUser($user) ) {

                    $data =  $this->respondWithToken2($token,$user);
                    return $this->responseSuccess($data, 'User Registered and Logged in Successfully', Response::HTTP_OK);
                }
            }
            else {
                return $this->responseError(['Wrong email or password']);
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    public function reSend(Request $request): JsonResponse
    {
        try {
            $email = $request->only('email');
            $value = $this->authRepository->sendcode($email);
            if($value){
                $data =  "Resend code to your email done";
                return $this->responseSuccess($data, 'Resend code  In Successfully !');
            }
            else{
                return $this->responseError('email not valid');
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function changePassword(Request $request): JsonResponse
    {
        try {
            $requestData = $request->only('code','email','password');
            
            $value = $this->authRepository->changePassword($requestData);;
            if($value){
                $data =  "Change Password is done";
                return $this->responseSuccess($data, 'Change Password In Successfully !');
            }
            else{
                return $this->responseError(['email or code not valid']);
            }
        
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    


    public function updateLocation(Request $request): JsonResponse
    {
        try {
            $data = $request->only('lat','lng');
            $user = $this->authRepository->updateLocation($data);
            if ($user) {
            return $this->responseSuccess(  $user,'update Location send Successfully !');
            }else{
                return $this->responseError('updateLocation or phone not valid');
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function updateUserInfo(LoginRequestMobile $request): JsonResponse
    {
        try {
            $phone = $request->only('phone','lat','lng');
            $user = $this->authRepository->updateUserInfo($phone);
            if ($user) {
            return $this->responseSuccess(  $user,'Code send Successfully !');
            }else{
                return $this->responseError('Wrong email or password');
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
        public function updateFmcUserToken(Request $request): JsonResponse
    {
        try {
            $data = $request->only('fcm_token','lat','lng');
            $user = $this->authRepository->updateFmcUserToken($data);
            if ($user) {
            return $this->responseSuccess(  $user,'Code send Successfully !');
            }else{
                return $this->responseError('Wrong email or password');
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\POST(
     *     path="/api/auth/register",
     *     tags={"Authentication"},
     *     summary="Register User",
     *     description="Register New User",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string", example="Jhon Doe"),
     *              @OA\Property(property="email", type="string", example="jhondoe@example.com"),
     *              @OA\Property(property="password", type="string", example="123456"),
     *              @OA\Property(property="password_confirmation", type="string", example="123456")
     *          ),
     *      ),
     *      @OA\Response(response=200, description="Register New User Data" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $requestData = $request->only('name', 'email', 'password', 'password_confirmation');
            $user = $this->authRepository->register($requestData);
            if ($user) {
                if ($token = JWTAuth::attempt($requestData)) {
                    $data =  $this->respondWithToken($token);
                    return $this->responseSuccess($data, 'User Registered and Logged in Successfully', Response::HTTP_OK);
                }
            }
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function topHunters(Request $request): JsonResponse
    {
        try {
            $data = $this->authRepository->topHunters($request->perPage);
            return $this->responseSuccess($data, 'Hunters List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function notification(Request $request): JsonResponse
    {
        try {
            $data = $this->authRepository->notification($request->perPage);
            return $this->responseSuccess($data, 'notification List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function popularHunters(Request $request): JsonResponse
    {
        try {
            $data = $this->authRepository->topHunters($request->perPage);
            return $this->responseSuccess($data, 'Hunters List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function hunters(Request $request): JsonResponse
    {
        try {
            $data = $this->authRepository->hunters($request->perPage);
            return $this->responseSuccess($data, 'Hunters List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function follow(Request $request)
    {
        try {
            $data = $this->authRepository->following($request->id);
            return $this->responseSuccess($data, 'Hunters followed Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Successfully followed user.'
        ]);
    }
    public function unfollow(Request $request)
    {
        try {
            $data = $this->authRepository->unfollowing($request->id);
            return $this->responseSuccess($data, 'Hunters Unfollowed Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Successfully followed user.'
        ]);
    }

    public function infoHunters($id)
    {
        try {
            $data = $this->authRepository->infoHunters($id);
            return $this->responseSuccess($data, 'Hunters Unfollowed Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Successfully followed user.'
        ]);
    }
    public function addWishlistsRealty(Request $request)
    {
        try {
            $data = $this->authRepository->addWishlistsRealty($request->id);
            return $this->responseSuccess($data, 'Wish brand Added Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Successfully followed user.'
        ]);
    }
    public function removeWishlistRealty(Request $request)
    {
        try {
            $data = $this->authRepository->removeWishlistRealty($request->id);
            return $this->responseSuccess($data, 'Wish brand removed Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Successfully followed user.'
        ]);
    }

    /**
     * @OA\GET(
     *     path="/api/auth/me",
     *     tags={"Authentication"},
     *     summary="Authenticated User Profile",
     *     description="Authenticated User Profile",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Authenticated User Profile" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function me(): JsonResponse
    {
        try {
            $data = JWTAuth::user();

            $profile = User::with('wishlists')->find($data->id);
            return $this->responseSuccess($profile, 'Profile Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function feedback(Request $request): JsonResponse
    {
        try {
            $data = $this->authRepository->feedback($request->all());
            return $this->responseSuccess($data, 'feedback Add Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    /**
     * @OA\POST(
     *     path="/api/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout",
     *     description="Logout",
     *     @OA\Response(response=200, description="Logout" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function logout(): JsonResponse
    {
        try {
            JWTAuth::logout();
            return $this->responseSuccess(null, 'Logged out successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\POST(
     *     path="/api/auth/refresh",
     *     tags={"Authentication"},
     *     summary="Refresh",
     *     description="Refresh",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Refresh" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function refresh(): JsonResponse
    {
        try {
            $data = $this->respondWithToken(JWTAuth::refresh());
            return $this->responseSuccess($data, 'Token Refreshed Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): array
    {
        $data = [[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60 * 24 * 360, // 43200 Minutes = 30 Days
            'user' => JWTAuth::user()
        ]];
        return $data[0];
    }
    protected function respondWithToken2($token,$user): array
    {
        $data = [[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60 * 24 * 360, // 43200 Minutes = 30 Days
            'user' => $user
        ]];
        return $data[0];
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard(): \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
    {
        return Auth::guard();
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $id = JWTAuth::user()->id;
            $data = $this->authRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Product Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Product Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
}
