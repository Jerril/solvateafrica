<?php

    namespace App\Repository\Eloquent;
    use App\Models\UserAccountType;
    use App\Repository\UserAccountTypeRepositoryInterface;

    class UserAccountTypeRepository extends BaseRepository implements UserAccountTypeRepositoryInterface
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

         public function __construct(UserAccountType $model)
         {
             $this->model = $model;
         }

    }

?>
