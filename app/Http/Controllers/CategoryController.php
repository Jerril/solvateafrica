<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryInterface;

    public function __construct(CategoryRepositoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/category/categories",
     *   tags={"Skill Category"},
     *   summary="Get List of all skill Categories",
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
    public function index()
    {
        try{
            $categories = $this->categoryInterface->all(['*'], ['skill']);
            return response()->json([ 'success' => true, 'categories' => $categories ]);
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
     ** path="/category/store",
     *   tags={"Skill Category"},
     *   summary="Create New Category",
     *   operationId="create_category",
     *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
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
    public function store(Category $request)
    {
        try{
            $newcategory = $this->categoryInterface->updateorcreate(['name' => $request->name],['name' => $request->name], ['skill']);
            return response()->json([ 'success' => true, 'category' => $newcategory ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Put(
     ** path="/category/{categoryId}",
     *   tags={"Skill Category"},
     *   summary="Update Category",
     *   operationId="update_category",
     *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="categoryId",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
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
    public function update(Category $request, $id)
    {
        try{
            $find = $this->categoryInterface->find($id);

            if($find == null)
                return response()->json([ 'success' => false, 'errors' => array('message' => 'Data not Found') ]);

            $newcategory = $this->categoryInterface->update($id, ['name' => $request->name] );
            return response()->json([ 'success' => true, 'category' => $newcategory ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
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
     ** path="/category/{categoryId}",
     *   tags={"Skill Category"},
     *   summary="Delete A Category",
     *   operationId="delete_category",
     *   security={{"bearer_token":{}}},
     *
     *  @OA\Parameter(
     *      name="categoryId",
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
    public function destroy($id)
    {
        try{
            $find = $this->categoryInterface->find($id);

            if($find == null)
                return response()->json([ 'success' => false, 'errors' => array('message' => 'Data not Found') ]);

            $this->categoryInterface->deleteById($id);
            return response()->json([ 'success' => true ]);
        }
        catch(Exception $ex)
        {
            return response()->json([ 'success' => false, 'errors' => array('message' => $ex.getMessage() ) ]);
        }
    }
}
