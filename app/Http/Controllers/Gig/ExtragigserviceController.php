<?php

namespace App\Http\Controllers\Gig;

use App\Http\Controllers\Controller;
use App\Http\Requests\Extragigservice;
use App\Repository\ExtragigRepositoryInterface;
use Illuminate\Http\Request;

class ExtragigserviceController extends Controller
{

    private $extraInterface;

    public function __construct(ExtragigRepositoryInterface $extraInterface)
    {
        $this->extraInterface = $extraInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/extraservice/get/{gigId}",
     *   tags={"Gig Extra Service"},
     *   summary="Get Gig Extra Service",
     *   operationId="getgigextraservice",
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
            $extraservices = $this->extraInterface->collectionbycondition([ 'userId' => Auth()->user()->id, 'gigId' => $id ]);
            return response()->json(['success' => true, 'extraservices' => $extraservices ]);
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
     ** path="/extraservice/store",
     *   tags={"Gig Extra Service"},
     *   summary="Create New GiG Extra Service",
     *   operationId="createnewextraservice",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="revision",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="price",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="gigId",
     *                     type="integer"
     *                 )
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
    public function store(Extragigservice $request)
    {
        try{
            $input = $request->all();
            $input['userId'] = $request->user()->id;
            $extraservice = $this->extraInterface->create($input);
            return response()->json(['success' => true, 'extraservice' => $extraservice ]);
        }catch(Exception $ex)
        {
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
     ** path="/extraservice/{serviceId}",
     *   tags={"Gig Extra Service"},
     *   summary="Extra Service",
     *   operationId="editextraservice",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="serviceId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *   ),
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="revision",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="price",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="gigId",
     *                     type="integer"
     *                 )
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
    public function update(Extragigservice $request, $id)
    {
        try{
            $exist = $this->extraInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $extraservice = $this->extraInterface->update($id, $request->all());
            return response()->json(['success' => true, 'extraservice' => $extraservice ]);
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
     ** path="/extraservice/{serviceId}",
     *   tags={"Gig Extra Service"},
     *   summary="Delete Extra Service",
     *   operationId="deleteservice",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="serviceId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
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
    public function destroy($id)
    {
        try{
            $exist = $this->extraInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $this->extraInterface->deleteById($id);
            return response()->json(['success' => true ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }
}
