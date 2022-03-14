<?php

namespace App\Http\Controllers\Gig;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery;
use Illuminate\Http\Request;
use App\Repository\GalleryRepositoryInterface;
use App\Repository\UploadFile\UploadFileInterface;
use Exception;
use Illuminate\Support\Arr;
use DB;

class Gallerycontroller extends Controller
{

    private $galleryInterface;
    private $uploadfileInterface;
    public function __construct(GalleryRepositoryInterface $galleryInterface, UploadFileInterface $uploadfile)
    {
        $this->galleryInterface = $galleryInterface;
        $this->uploadfileInterface = $uploadfile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/gallery/get/{gigId}",
     *   tags={"Gallery"},
     *   summary="Get Gallery",
     *   operationId="getgallery",
     *   security={{"bearer_token":{}}},
     *
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
            $galleries = $this->galleryInterface->GetById('id', $id);
            return response()->json(['success' => true, 'galleries' => $galleries ]);
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
     ** path="/gallery/store",
     *   tags={"Gallery"},
     *   summary="Create Gallery",
     *   operationId="creategallery",
     *   security={{"bearer_token":{}}},
     *
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="gigId",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="profile_image",
     *                     type="string",
     *                     format="binary",
     *
     *                 ),
     *
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
    public function store(Gallery $request)
    {
        try{

            $input = $request->all();
            $input['userId'] = $request->user()->id;
            $input['images'] = $request->profile_image;

                $img = $this->uploadfileInterface->UploadFile($request->profile_image,"/images/galleries",true, 250, 250);
                $data =  array('image' => $img, 'gigId' => $request->gigId, 'userId' => auth()->user()->id );
           
            $this->galleryInterface->insert($data);

            return response()->json(['success' => true ]);

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
     ** path="/gallery/{galleryId}",
     *   tags={"Gallery"},
     *   summary="Edit Gallery",
     *   operationId="editgallery",
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
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="image",
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
    public function update(Gallery $request, $id)
    {
        try{

            $exist = $this->gigInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $img = $this->uploadfileInterface->UploadFile($request->file('img'),"/images/galleries");

            $gallery = $this->gigInterface->update($id, ['image' => $img, 'gigId' => $request->gigId]);

            return response()->json(['success' => true, 'gallery' => $gallery ]);

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
     ** path="/gallery/{galleryId}",
     *   tags={"Gallery"},
     *   summary="Delete Gallery",
     *   operationId="deletegallery",
     *   security={{"bearer_token":{}}},
     *   @OA\Parameter(
     *          name="galleryId",
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

            $exist = $this->galleryInterface->findOne(['id' => $id, 'userId' => auth()->user()->id ]);

            if(!$exist)
                return response()->json(['success' => false, 'error' => array('message' => "Data not Found" ) ]);

            $status = $this->galleryInterface->deleteById($id);
            return response()->json(['success' => $status ]);
        }catch(Exception $ex)
        {
            return response()->json(['success' => false, 'error' => array('message' => $ex->getMessage() ) ]);

        }
    }
}
