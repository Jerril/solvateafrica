<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gig;
use App\Http\Requests\Project;
use Illuminate\Http\Request;
use App\Repository\ProjectManagementRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use DB;

class ProjectController extends Controller
{

    private $projectInterface;

    public function __construct(ProjectManagementRepositoryInterface $projectInterface)
    {
        $this->projectInterface = $projectInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/project/get",
     *   tags={"Project Management"},
     *   summary="Get User Projects",
     *   operationId="getuserprojects",
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
            $projects = $this->projectInterface->GetProjects(Auth()->user()->id);
            return response()->json(['success' => true, 'projects' => $projects ]);
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
     ** path="/project/store",
     *   tags={"Project Management"},
     *   summary="Create New Project",
     *   operationId="createnewproject",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="end_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cost",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="observerId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="tracked_order_id",
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
    public function store(Project $request)
    {
        try{
            $input = $request->all();
            $input["userId"] = auth()->user()->id;

            $project = $this->projectInterface->create($input);

            return response()->json(['success' => true, 'project' => $project ]);

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
     ** path="/project/{projectId}",
     *   tags={"Project Management"},
     *   summary="Edit Project",
     *   operationId="editproject",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="projectId",
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
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="end_date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cost",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="observerId",
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
    public function update(Project $request, $id)
    {
        try{
            $exist = $this->projectInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $project = $this->projectInterface->update($id, $request->all());
            return response()->json(['success' => true, 'gig' => $project ]);
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
     ** path="/project/{projectId}",
     *   tags={"Project Management"},
     *   summary="Delete Project",
     *   operationId="deleteproject",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="projectId",
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

            $exist = $this->projectInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $status = $this->projectInterface->deleteById($id);
            return response()->json(['success' => $status ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }

    /**
     * @OA\Get(
     ** path="/project/getprojectsbyuser",
     *   tags={"Project Management"},
     *   summary="Get User Projects",
     *   operationId="getprojectsbyuser",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="userId",
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
    public function getProjectsByUser($id)
    {
        try{
            $projects = $this->projectInterface->GetProjectsByUser($id);
            return response()->json(['success' => true, 'projects' => $projects ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => true, 'error' => array('message' => $ex->getMessage() ) ]);
        }

    }

    /**
     * @OA\Get(
     ** path="/project/getprojectsbytrackedorderid",
     *   tags={"Project Management"},
     *   summary="Get Tracked Order Projects",
     *   operationId="getprojectsbytrackedorderid",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="trackedOrderId",
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
    public function getProjectsByTrackedOrderId($id)
    {
        try{
            $projects = $this->projectInterface->GetProjectsByTrackedOrderId($id);
            return response()->json(['success' => true, 'projects' => $projects ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => true, 'error' => array('message' => $ex->getMessage() ) ]);
        }

    }
}
