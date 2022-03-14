<?php

    namespace App\Repository\Eloquent;
    use App\Models\UserDetail;
    use App\Repository\UserProfileRepositoryInterface;

    class UserProfileRepository extends BaseRepository implements UserProfileRepositoryInterface
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

         public function __construct(UserDetail $model)
         {
             $this->model = $model;
         }

        

    }

?>
