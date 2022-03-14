<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Profile;
use App\Http\Requests\AccountType;
use App\Models\User;
use App\Repository\UserProfileRepositoryInterface;
use App\Repository\UploadFile\UploadFileInterface;
use Intervention\Image\ImageManagerStatic as Image;
use App\Repository\UserAccountTypeRepositoryInterface;
use DB;

class UserProfileController extends Controller
{
    private $userprofileRepository;
    private $uploadfileRepository;
    private $useraccounttypeInterface;

    public function __construct(UserAccountTypeRepositoryInterface $useraccounttypeInterface, UserProfileRepositoryInterface $userprofileRepository, UploadFileInterface $uploadfileRepository)
    {
        $this->userprofileRepository = $userprofileRepository;
        $this->uploadfileRepository = $uploadfileRepository;
        $this->useraccounttypeInterface = $useraccounttypeInterface;
    }

     /**
     * @OA\Post(
     ** path="/updateorcreateprofile",
     *   tags={"Profile"},
     *   summary="Update Profile",
     *   operationId="updateprofile",
     *   security={{"bearer_token":{}}},
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="firstname",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="lastname",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="gender",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone_number",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="countryId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="stateId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="accounttypeId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="profile_image",
     *                     type="string",
     *                     format="binary",
     *                 ),
     *
     *             )
     *         )
     *     ),
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


    public function updateorcreate(Profile $request)
    {
        $input = $request->all();
        $input['userId'] = $request->user()->id;

        DB::BeginTransaction();

        try{
            if($request->hasFile('profile_image'))
            {
                $name = $this->uploadfileRepository->UploadFile($request->file('profile_image'), 'images/profiles', true, 250, 250);
                $input['profile_image'] = $name;
            }

            $detail = $this->userprofileRepository->updateOrCreate(['userId' => $request->user()->id], $input,['user']);
            $accounttype = $this->useraccounttypeInterface->updateOrCreate(['userId' => $request->user()->id, 'accounttypeId' => $request->accounttypeId],$input);
            DB::commit();
            return response()->json(['success' => true, 'userdetail' => $detail, 'useraccounttype' => $accounttype ]);
        }catch(Exception $ex)
        {
            DB::rollback();
            return response()->json(['success' => false, 'error' =>  array('message' => $ex->getMessage() )]);
        }

    }


    /**
     * @OA\Post(
     ** path="/updateorcreateaccounttype",
     *   tags={"User Account Type"},
     *   summary="User Account Type",
     *   operationId="updateorcreateaccounttype",
     *   security={{"bearer_token":{}}},
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="userId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="accounttypeId",
     *                     type="integer"
     *                 ),
     *             )
     *         )
     *     ),
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

    public function account_type_updateorcreate(AccountType $request)
    {
        $input = $request->all();
        $accounttype = $this->accountTypeRepository->updateorcreate(['userId' => $request->user()->id, 'accounttypeId' => $request->accounttypeId],$input);
        return response()->json(['success' => true, 'accountype' =>  $accounttype ]);
    }



    /**
     * @OA\Get(
     ** path="/get_accounttype",
     *   tags={"User Account Type"},
     *   summary="User Account Type",
     *   operationId="get_accounttype",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="userId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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

    public function get_account_type(AccountType $request)
    {
        $accounttypes = $this->accountTypeRepository->GetById('userId',$request->user()->id);
        return response()->json(['success' => true, 'accountypes' =>  $accounttypes ]);
    }

    public function getuser($id){
		try {
			$users = User::where('id', $id)->first()->load('userdetail', 'educations', 'certifications', 'workprofiles', 'skills', 'languages');
    		return response()->json([ 'success'=>true, 'users'=>$users ]);
		}
		catch(Exception $ex)
		{
			return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
		}
    }
}
