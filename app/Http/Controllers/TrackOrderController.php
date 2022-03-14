<?php

namespace App\Http\Controllers;

use App\Models\Trackorder;
use App\Models\Job;
use App\Http\Requests\StoretrackorderRequest;
use App\Http\Requests\UpdatetrackorderRequest;

class TrackorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/trackorder/get",
     *   tags={"Tracked Orders (Project Management)"},
     *   summary="Get Tracked Orders",
     *   operationId="gettrackedorders",
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
        //
        try {
            $orders = Trackorder::where('hunter_id', auth()->user()->id)->get()->load('job');

            return response()->json([ 'success' => true, 'orders' => $orders ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
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
     * @param  \App\Http\Requests\StoretrackorderRequest  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     ** path="/trackorder/store{id}",
     *   tags={"Track Order (Project Management)"},
     *   summary="Track New Order/Job",
     *   operationId="trackneworder",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="job_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="hunter_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="talent_id",
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
    public function store(StoretrackorderRequest $request, $id)
    {

        try {
            $job = Job::where('id', $id)->get();

            $new_order = Trackorder::create([
                'job_id' => $id,
                'hunter_id' => $job[0]->user_id,
                'talent_id' => $job[0]->creative_id,
            ]);

            return response()->json([ 'success' => true, 'order' => $new_order ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trackorder  $trackorder
     * @return \Illuminate\Http\Response
     */
    public function show(Trackorder $trackorder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trackorder  $trackorder
     * @return \Illuminate\Http\Response
     */
    public function edit(Trackorder $trackorder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetrackorderRequest  $request
     * @param  \App\Models\Trackorder  $trackorder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetrackorderRequest $request, Trackorder $trackorder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trackorder  $trackorder
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     ** path="/trackorder/{trackedOrderId}",
     *   tags={"Delete Tracked Order (Project Management)"},
     *   summary="Delete Tracked Order",
     *   operationId="deletetrackedorder",
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
    public function destroy(Trackorder $trackorder, $id)
    {
        //
        try {
            $tracked_order = Trackorder::find($id);

            if(!$tracked_order)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $status = $tracked_order->delete();
            return response()->json([ 'success' => $status ]);

            // delete associated projects
            // delete associated task container
            // delete associated tasks
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage()) ]);
        }

    }
}
