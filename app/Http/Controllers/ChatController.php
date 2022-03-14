<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\GiG;
use App\Models\Job;
use App\Models\Project;
use App\Models\Chat;

class ChatController extends Controller
{

    

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/chat/getconversations",
     *   tags={"Chat"},
     *   summary="get list of all conversations",
     *   operationId="getcategories",
     *   security={{"bearer_token":{}}},
     *
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
    public function getConversations()
    {
        try{
            $chats =  Chat::where('sender_id', auth()->user()->id)->orWhere('recipient_id', auth()->user()->id)->groupBy('recipient_id')->with('sender', 'recipient')->get();
            return response()->json([ 'success' => true, 'categories' => $chats ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     ** path="/chat/sendmessage",
     *   tags={"Chat"},
     *   summary="send message",
     *   operationId="sendMessage",
     *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="recipient_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
      *  @OA\Parameter(
     *      name="message",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
      *  @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
      *  @OA\Parameter(
     *      name="attachment",
      *      in="query",
     *      required=false,
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
    public function sendMessage(Request $request)
    {

        try{
           $chat =  Chat::create([
                'sender_id' => auth()->user()->id,
                'recipient_id' => $request->recipient_id,
                'message' => $request->message ,
                'title' => $request->title ,
                'attachment' => $request->attachment
            ]);

            return response()->json([ 'success' => true, 'chat' => $chat->load('sender','recipient') ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
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

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        /**
     * @OA\Delete(
     ** path="/chat/{id}",
     *   tags={"Chat"},
     *   summary="delete a chat",
     *   operationId="deleteMessage",
     *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
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
    public function deleteMessage($id)
    {
        try{
            Chat::where('id', $id)->delete();
            return response()->json([ 'success' => true ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/chat/getconversation",
     *   tags={"Chat"},
     *   summary="get conversation between two users",
     *   operationId="getconversation",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\Parameter(
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
    public function getConversation($id)
    {
        try{
            $chats =  Chat::where(function($query) use ($id){ 
                            $query->where('sender_id', auth()->user()->id)
                                  ->where('recipient_id', $id);
                        })->orWhere(function($query) use ($id){ 
                            $query->where('sender_id', $id)
                                  ->where('recipient_id', auth()->user()->id);
                        })->latest()
                        ->with('sender', 'recipient')
                        ->get();

            return response()->json([ 'success' => true, 'messages' => $chats ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/chat/getsentmessages",
     *   tags={"Chat"},
     *   summary="get list of sent messages",
     *   operationId="getsentmessages",
     *   security={{"bearer_token":{}}},
     *
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
    public function getSentMessages()
    {
        try{
            $chats =  Chat::where('sender_id', auth()->user()->id)
                            ->latest()
                            ->with('recipient:id,name')
                            ->get()
                            ->unique('recipient_id');

            return response()->json([ 'success' => true, 'categories' => $chats ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }

    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/chat/getreceivedmessages",
     *   tags={"Chat"},
     *   summary="get list of received messages",
     *   operationId="getreceivedmessages",
     *   security={{"bearer_token":{}}},
     *
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
    public function getReceivedMessages()
    {
        try{
            $chats =  Chat::where('recipient_id', auth()->user()->id)
                            ->latest()
                            ->with('sender:id,name')
                            ->get()
                            ->unique('sender_id');

            return response()->json([ 'success' => true, 'categories' => $chats ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }

    }
}
