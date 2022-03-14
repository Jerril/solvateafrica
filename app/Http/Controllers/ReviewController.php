<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="review/getallreviews",
     *   tags={"Review"},
     *   summary="Get all reviews sent on the system",
     *   operationId="index",
     *   security={{"bearer_token":{}}},
     *
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function index()
    {
        //
        return response()->json([ 'reviews' => Review::all() ]);
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
     ** path="review/sendreview",
     *   tags={"Review"},
     *   summary="Send review",
     *   operationId="store",
     *   security={{"bearer_token":{}}},
     *
     * @OA\Parameter(
     *      name="reviewer_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="reviewee_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="job_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="rating",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="recommend_user",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="comment",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function store(Request $request)
    {
        //
        try {
            $review = Review::create([
                'reviewer_id' => $request->reviewer_id,
                'reviewee_id' => $request->reviewee_id,
                'job_id' => $request->job_id,
                'rating' => $request->rating,
                'recommend_user' => $request->recommend_user,
                'comment' => $request->comment
            ]);

            return response()->json([ 'success' => true, 'review' => $review ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }

    /**
     * @OA\Get(
     ** path="review/getsentreviews",
     *   tags={"Review"},
     *   summary="Get reviews you sent",
     *   operationId="getSentReviews",
     *   security={{"bearer_token":{}}},
     *
     * @OA\Parameter(
     *      name="user_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function getSentReviews($id)
    {
        $sent_reviews = Review::where('reviewer_id', $id)->get()->load('reviewee', 'job');
        return response()->json([ 'success' => true, 'sent_reviews' => $sent_reviews]);
    }

    /**
     * @OA\Get(
     ** path="review/getreceivedreviews",
     *   tags={"Review"},
     *   summary="Get reviews you received",
     *   operationId="getReceivedReviews",
     *   security={{"bearer_token":{}}},
     *
     * @OA\Parameter(
     *      name="user_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function getReceivedReviews($id)
    {
        $received_reviews = Review::where('reviewee_id', $id)->get()->load('reviewer', 'job');
        return response()->json([ 'success' => true, 'received_reviews' => $received_reviews]);
    }

    /**
     * @OA\Get(
     ** path="review/getjobreviews",
     *   tags={"Review"},
     *   summary="Get reviews for a job",
     *   operationId="getJobReviews",
     *   security={{"bearer_token":{}}},
     *
     * @OA\Parameter(
     *      name="job_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function getJobReview($id)
    {
        $job_reviews = Review::where('job_id', $id)->get()->load('reviewer', 'reviewee');
        return response()->json([ 'success' => true, 'job_reviews' => $job_reviews]);
    }
}
