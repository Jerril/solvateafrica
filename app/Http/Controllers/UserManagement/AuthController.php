<?php

namespace App\Http\Controllers\UserManagement;
use App\Repository\UserRepositoryInterface;
use App\Repository\ForgotPasswordRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UserLogin;
use App\Http\Requests\ForgotPassword;
use App\Http\Requests\ResetPassword;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Str;
use App\Http\Requests\SocialMediaUser;
use App\Repository\UserAccountTypeRepositoryInterface;
use App\Repository\UserProfileRepositoryInterface;
use App\Repository\GeneralAccountTypeRepositoryInterface;


class AuthController extends Controller
{
    private $userRepository;
    private $forgotpasswordRepository;
    private $useraccounttypeInterface;
    private $userprofileRepository;
    private $generalaccounttype;

    public function __construct(UserProfileRepositoryInterface $userprofileRepository,
                                UserAccountTypeRepositoryInterface $useraccounttypeInterface,
                                GeneralAccountTypeRepositoryInterface $generalaccounttype,
                                UserRepositoryInterface $userRepository,
                                ForgotPasswordRepositoryInterface $forgotpasswordRepository)
    {
        $this->userRepository = $userRepository;
        $this->forgotpasswordRepository = $forgotpasswordRepository;
        $this->useraccounttypeInterface = $useraccounttypeInterface;
        $this->userprofileRepository = $userprofileRepository;
        $this->generalaccounttype = $generalaccounttype;


    }

    //Email Test
    public function testmail()
    {
        return response()->json(['success' => true, 'user' => Str::random(60) ]);
    }

    //Verify Account
    public function verifyaccount(Request $request)
    {
        $verification_code = $request->query('verifyaccount');
        $user = $this->userRepository->findOne(['verification_code' => $verification_code]);
        if($user == null)
            return response()->json(['success' => false, 'error' =>  array('message' => 'Code not Found') ]);

        try{
            $this->userRepository->update($user->id, ['email_verified_at' => date_format(date('Y-m-d'), 'Y-m-d H:i:s') ]);
            return response()->json(['success' => true, 'message' => 'Account Verified Successfully' ]);
        }
        catch(Exception $ex)
        {
            return response()->json(['success' => false ]);
        }
    }

    /**
     * @OA\Post(
     ** path="/socialmediaregister",
     *   tags={"Auth"},
     *   summary="Social Media Register",
     *   operationId="socialmediaregister",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="signup_channel",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function socialmediaregister(SocialMediaUser $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $newuser = $this->userRepository->create($input);
        return response()->json(['success' => true, 'user' => $newuser ]);
    }

     /**
     * @OA\Post(
     ** path="/socialmedialogin",
     *   tags={"Auth"},
     *   summary="Social Media Login",
     *   operationId="socialmedialogin",
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function socialmedialogin(UserLogin $request)
    {

        if (!auth()->attempt($request->all())) {
            $error['message'] = 'Invalid Credentials';
            return response(['success' => false, 'error' => $error]);
        }

        $accessToken = auth()->user()->createToken('authToken');

        $useraccounttype = $this->useraccounttypeInterface->collectionbycondition(['userId' => auth()->user()->id]);

        $accounttype = $this->generalaccounttype->all();

        $user_details = $this->userprofileRepository->findOne(['userId' => auth()->user()->id]);



        return response()->json(['success' => true,
                                'user' => auth()->user(),
                                'user_profile' => $user_details,
                                'token' => $accessToken->plainTextToken,
                                'user_account_types' => $useraccounttype,
                                'general_account_types' => $accounttype ]);

    }

    /**
     * @OA\Post(
     ** path="/register",
     *   tags={"Auth"},
     *   summary="Register",
     *   operationId="register",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function register(StoreUser $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $newuser = $this->userRepository->create($input);
        return response()->json(['success' => true, 'user' => $newuser ]);
    }

     /**
     * @OA\Post(
     ** path="/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function login(UserLogin $request)
    {

        if (!auth()->attempt($request->all())) {
            $error['message'] = 'Invalid Credentials';
            return response(['success' => false, 'error' => $error]);
        }

        $accessToken = auth()->user()->createToken('authToken');

        $useraccounttype = $this->useraccounttypeInterface->collectionbycondition(['userId' => auth()->user()->id]);

        $accounttype = $this->generalaccounttype->all();

        $user_details = $this->userprofileRepository->findOne(['userId' => auth()->user()->id]);



        return response()->json(['success' => true,
                                'user' => auth()->user(),
                                'user_profile' => $user_details,
                                'token' => $accessToken->plainTextToken,
                                'user_account_types' => $useraccounttype,
                                'general_account_types' => $accounttype ]);
    }


    /**
     * @OA\Post(
     ** path="/forgotpassword",
     *   tags={"Auth"},
     *   summary="Forgot Password",
     *   operationId="forgotpassword",
     *
     *  *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function forgotpassword(ForgotPassword $request)
    {
        $input = $request->all();
        $user = $this->userRepository->findOne(['email' => $request->email ]);

        if($user == null)
            return response()->json(['success' => false, 'error' =>  array('message' => 'User not Found') ]);

        $input['code'] = mb_substr(uniqid(), 0, 6);
        $input['userId'] = $user->id;
        $this->forgotpasswordRepository->create($input);

        return response()->json(['success' => true, 'message' => 'A Code has been sent to Email. Use the code to reset your Password' ]);
    }



     /**
     * @OA\Put(
     ** path="/resetpassword",
     *   tags={"Auth"},
     *   summary="Reset Password",
     *   operationId="resetpassword",
     *
     *  *  @OA\Parameter(
     *      name="code",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *  *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  *  *  @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function resetpassword(ResetPassword $request)
    {
        $input = $request->all();
        $forgot = $this->forgotpasswordRepository->findCode('code', $request->code);

        if($forgot == null)
            return response()->json(['success' => false, 'error' =>  array('message' => 'Code not Found or Expired') ]);

        $input['password'] = bcrypt($request->password);

        $user = $this->userRepository->update($forgot->userId, $input);
        $this->forgotpasswordRepository->update($forgot->id, ['active' => false]);

        return response()->json(['success' => true, 'message' => 'Password Reset Successfully', 'user' => $user ]);
    }
}
