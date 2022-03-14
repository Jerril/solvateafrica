<?php

    namespace App\Repository\Eloquent;
    use App\Models\Country;
    use App\Repository\CountryRepositoryInterface;

    class CountryRepository extends BaseRepository implements CountryRepositoryInterface
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

         public function __construct(Country $model)
         {
             $this->model = $model;
         }

    }

?>
