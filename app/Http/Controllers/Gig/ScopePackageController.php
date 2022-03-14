<?php

namespace App\Http\Controllers\Gig;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScopePackage;
use App\Repository\ScopePackageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;

class ScopePackageController extends Controller
{

    private $scopeInterface;
    public function __construct(ScopePackageRepositoryInterface $scopeInterface)
    {
        $this->scopeInterface = $scopeInterface;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

         /**
     * @OA\Get(
     ** path="/scopepackage/get/{gigId}",
     *   tags={"Gig Scope Package"},
     *   summary="Get User Gig Scope Package",
     *   operationId="getusergigscopepackage",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="gigId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
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
    public function index($id)
    {
        try{
            $scope = $this->scopeInterface->GetScope(['userId' => auth()->user()->id, 'gigId' => $id ]);
            return response()->json(['success' => true, 'scope' => $scope ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => true, 'error' => array('message' => $ex->getMessage() ) ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     ** path="/scopepackage/store",
     *   tags={"Gig Scope Package"},
     *   summary="Create Gig Scope",
     *   operationId="creategigscope",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="gigId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(property="packages", type="object",
     *                    type="array",
     *                    @OA\Items(
     *                      @OA\Property(property="package", type="string", example="Basic"),
     *                      @OA\Property(property="offers", type="string", example="My Offers"),
     *                      @OA\Property(property="delivery", type="integer", example="30"),
     *                      @OA\Property(property="revisions", type="integer", example="30"),
     *                      @OA\Property(property="price", type="integer", example="30000"),
     *                    ),
     *                 ),
     *             )
     *         )
     *     ),
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
    public function store(ScopePackage $request)
    {
        try{
            DB::BeginTransaction();

            foreach($request->packages as $package)
            {
                $package = Arr::add($package,'userId',auth()->user()->id);
                $package = Arr::add($package,'gigId',$request->gigId);
                $this->scopeInterface->create($package);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'scope' => $this->scopeInterface->GetScope(['userId' => auth()->user()->id, 'gigId' => $request->gigId]) ]);
        }catch(Exception $ex)
        {
            DB::rollback();
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Put(
     ** path="/scopepackage/{scopeId}",
     *   tags={"Gig Scope Package"},
     *   summary="Edit Gig Scope Package",
     *   operationId="editgigscopepackage",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="scopeId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *   ),
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="package",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="gigId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="offers",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="revisions",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="delivery",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="integer"
     *                 ),
     *             )
     *         )
     *     ),
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
    public function update(ScopePackage $request, $id)
    {
        try{
            $exist = $this->scopeInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $scope = $this->scopeInterface->update($id, $request->all());
            return response()->json(['success' => true, 'scope' => $scope ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     ** path="/scopepackage/{scopeId}",
     *   tags={"Gig Scope Package"},
     *   summary="Delete Gig",
     *   operationId="deletegigscopepackage",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="scopeId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
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
    public function destroy($id)
    {
        try{

            $exist = $this->scopeInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $status = $this->scopeInterface->deleteById($id);
            return response()->json(['success' => $status ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }
}
