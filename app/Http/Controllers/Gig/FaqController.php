<?php

namespace App\Http\Controllers\Gig;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq;
use Illuminate\Http\Request;
use App\Repository\FaqRepositoryInterface;

class FaqController extends Controller
{

    private $faqInterface;
    public function __construct(FaqRepositoryInterface $faqInterface)
    {
        $this->faqInterface = $faqInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     ** path="/faq/get/{gigId}",
     *   tags={"Gig Faq"},
     *   summary="Get Gig Faq",
     *   operationId="getgigfaq",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="gigId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
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
    public function index($id)
    {
        try{
            $faqs = $this->faqInterface->collectionbycondition(['gigId' =>  $id, 'userId' => auth()->user()->id ] );
            return response()->json(['success' => true, 'faqs' => $faqs ]);
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
     ** path="/faq/store",
     *   tags={"Gig Faq"},
     *   summary="Create New Faq",
     *   operationId="createnewfaq",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="faq",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="answer",
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
    public function store(Faq $request)
    {
        try{
            $input = $request->all();
            $input['userId'] = $request->user()->id;
            $faq = $this->faqInterface->create($input);
            return response()->json(['success' => true, 'faq' => $faq ]);
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
     ** path="/faq/{faqId}",
     *   tags={"Gig Faq"},
     *   summary="Edit Faq",
     *   operationId="editfaq",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="faqId",
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
     *                     property="faq",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="answer",
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
    public function update(Faq $request, $id)
    {
        try{
            $exist = $this->faqInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $faq = $this->faqInterface->update($id, $request->all());
            return response()->json(['success' => true, 'faq' => $faq ]);
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
     ** path="/faq/{faqId}",
     *   tags={"Gig Faq"},
     *   summary="Delete Faq",
     *   operationId="deletefaq",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="faqId",
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
            $exist = $this->faqInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);


            $gig = $this->faqInterface->deleteById($id);
            return response()->json(['success' => true ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }
}
