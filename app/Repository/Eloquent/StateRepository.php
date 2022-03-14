<?php

    namespace App\Repository\Eloquent;
    use App\Models\State;
    use App\Repository\StateRepositoryInterface;

    class StateRepository extends BaseRepository implements StateRepositoryInterface
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

         public function __construct(State $model)
         {
             $this->model = $model;
         }

    }

?>
