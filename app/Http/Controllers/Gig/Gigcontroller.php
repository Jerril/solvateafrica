<?php

namespace App\Http\Controllers\Gig;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gig;
use Illuminate\Http\Request;
use App\Repository\GiGRepositoryInterface;
use App\Repository\TagRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use DB;
use App\Models\GiG as G;


class Gigcontroller extends Controller
{


    private $tagInterface;
    private $gigInterface;
    public function __construct(GiGRepositoryInterface $gigInterface, TagRepositoryInterface $tagInterface)
    {
        $this->gigInterface = $gigInterface;
        $this->tagInterface = $tagInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/gig/get",
     *   tags={"Gig"},
     *   summary="Get User Gigs",
     *   operationId="getusergigs",
     *   security={{"bearer_token":{}}},
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
    public function index()
    {
        try{
            $gigs = $this->gigInterface->GetById('userId', Auth()->user()->id, ['tags','category','skill','faqs','questions','extraservice','scopepackage','user','userdetail']);
            return response()->json(['success' => true, 'gigs' => $gigs ]);
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
     ** path="/gig/store",
     *   tags={"Gig"},
     *   summary="Create New Gig",
     *   operationId="createnewgig",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="categoryId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="skillId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(property="tags", type="object",
     *                    type="array",
     *                    @OA\Items(
     *                      @OA\Property(property="tag", type="string", example="Laravel"),
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
    public function store(Gig $request)
    {
        try{
            DB::BeginTransaction();

            $input = $request->all();
            $input['userId'] = $request->user()->id;

            $gig = $this->gigInterface->create($input);

            if(count($request->tags) > 0)
                $this->tagInterface->TagMassInsertion($request->tags, $gig->id);

            $newgig = $this->gigInterface->findWithTags($gig->id, ['tags']);

            DB::commit();
            return response()->json(['success' => true, 'gig' => $newgig ]);
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
    /**
     * @OA\Get(
     ** path="/gig/{id}",
     *   tags={"Gig"},
     *   summary="show Gig",
     *   operationId="show",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="id",
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

    public function show(Request $request,$id)
    {  
    try{

       $gig = G::with('category','skill','tags','user','userdetail','faqs','questions','extraservice','scopepackage')->where('id', $id)->get();
       
         return response()->json(['success' => true, 'gig' => $gig ]);
          }catch(Exception $ex)
        {
             return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
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
     ** path="/gig/{id}",
     *   tags={"Gig"},
     *   summary="Edit Gig",
     *   operationId="editgig",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="id",
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
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="categoryId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="skillId",
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
    public function update(Gig $request, $id)
    {
        try{
            $exist = $this->gigInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $gig = $this->gigInterface->update($id, $request->all());
            return response()->json(['success' => true, 'gig' => $gig ]);
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
     ** path="/gig/{gigId}",
     *   tags={"Gig"},
     *   summary="Delete Gig",
     *   operationId="deletegig",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="gigId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *   ),
      *   @OA\RequestBody(
     *         required=false,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
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
    public function destroy($id)
    {
        try{

            $exist = $this->gigInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $status = $this->gigInterface->deleteById($id);
            return response()->json(['success' => $status ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }

     /**
     * @OA\Get(
     ** path="/gig/search",
     *   tags={"Gig"},
     *   summary="search Gigs",
     *   operationId="search",
     *   security={{"bearer_token":{}}},
     *    @OA\Parameter(
     *          name="title",
     *          required=false,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
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

    public function search(Request $request)
    { //title, description

    try{

        $gigBuilder = G::with('category','skill','tags','user','userdetail');
      return response()->json(['success' => true, 'gigs' => G::paginate(10) ]);
        if($request->has('title')){
        $title = $request->input('title');
        $gigBuilder->where('title', 'LIKE', "%{$title}%");
       } 

     /*   if($request->has('description')){
            $description = $request->input('description');
        $gigBuilder->where('description', 'LIKE', "%{$description}%");
       }*/
       return response()->json(['success' => true, 'gigs' => $gigBuilder->paginate(10) ]);
          }catch(Exception $ex)
        {
             return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }

    /**
     * @OA\Get(
     ** path="/gig/getallgigs",
     *   tags={"Gig"},
     *   summary="Get all Gigs",
     *   operationId="getallgigs",
     *   security={{"bearer_token":{}}},
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
    public function getallgigs()
    {
        try{
            $gigs = G::all()->load('tags','category','skill','faqs','questions','extraservice','scopepackage','user','userdetail');
            return response()->json(['success' => true, 'gigs' => $gigs ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => true, 'error' => array('message' => $ex->getMessage() ) ]);
        }

    }

    /**
     * @OA\Get(
     ** path="/gig/getusergigs/{id}",
     *   tags={"Gig"},
     *   summary="Get User Gigs",
     *   operationId="getusergigs",
     *   security={{"bearer_token":{}}},
     *    @OA\Parameter(
     *          name="id",
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
    public function getusergigs($id)
    {
        try{
            $gigs = G::where('userId', $id)->get()->load('tags','category','skill','faqs','questions','extraservice','scopepackage','user','userdetail');
            return response()->json(['success' => true, 'gigs' => $gigs ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => true, 'error' => array('message' => $ex->getMessage() ) ]);
        }

    }
}
