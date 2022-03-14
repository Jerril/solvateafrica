<?php

    namespace App\Repository\Eloquent;
    use App\Models\City;
    use App\Repository\CityRepositoryInterface;

    class CityRepository extends BaseRepository implements CityRepositoryInterface
    {
         /**
         * @var Model
         */
        protected $model;

        /**
         * BaseRepository constructor
         * 
         * @param Model $model
         */

         public function __construct(City $model)
         {
             $this->model = $model;
         }

    }

?>
