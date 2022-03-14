<?php

    namespace App\Repository\Eloquent;
    use App\Models\WorkProfile;
    use App\Repository\UserRepositoryInterface;

    class WorkProfileRepository extends BaseRepository implements UserRepositoryInterface
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

         public function __construct(WorkProfile $model)
         {
             $this->model = $model;
         }

    }

?>
