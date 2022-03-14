<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\CityRepositoryInterface;
use App\Repository\StateRepositoryInterface;
use App\Repository\CountryRepositoryInterface;

class LocationController extends Controller
{
    private $countryRepository;
    private $stateRepository;
    private $cityRepository;

    public function __construct(CountryRepositoryInterface $countryRepository, StateRepositoryInterface $stateRepository, CityRepositoryInterface $cityRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @OA\Get(
     ** path="/get_countries",
     *   tags={"Location"},
     *   summary="Get Country",
     *   operationId="getcountry",
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

    public function getcountries()
    {
        $countries = $this->countryRepository->all();
        return response()->json(['success' => true, 'countries' => $countries ]);
    }


    /**
     * @OA\Get(
     ** path="/get_states/{countryId}",
     *   tags={"Location"},
     *   summary="Get States",
     *   operationId="getstates",
     * 
     * @OA\Parameter(
     *      name="countryId",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
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
    public function getstates($id)
    {
        $states = $this->stateRepository->GetById('countryId', $id);
        return response()->json(['success' => true, 'states' => $states ]);
    }


    /**
     * @OA\Get(
     ** path="/get_cities/{stateId}",
     *   tags={"Location"},
     *   summary="Get Cities",
     *   operationId="getcities",
     *
     *  * @OA\Parameter(
     *      name="stateId",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
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
     * 
     *   @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function getcities($id)
    {
        $cities = $this->cityRepository->GetById('stateId', $id);
        return response()->json(['success' => true, 'cities' => $cities ]);
    }
}
