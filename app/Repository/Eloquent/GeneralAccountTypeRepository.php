<?php

    namespace App\Repository\Eloquent;
    use App\Models\AccountType;
    use App\Repository\GeneralAccountTypeRepositoryInterface;

    class GeneralAccountTypeRepository extends BaseRepository implements GeneralAccountTypeRepositoryInterface
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

         public function __construct(AccountType $model)
         {
             $this->model = $model;
         }

    }

?>
