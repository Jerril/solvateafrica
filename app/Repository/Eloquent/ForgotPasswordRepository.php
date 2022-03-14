<?php

    namespace App\Repository\Eloquent;
    use App\Models\ForgotPassword;
    use App\Repository\ForgotPasswordRepositoryInterface;

    class ForgotPasswordRepository extends BaseRepository implements ForgotPasswordRepositoryInterface
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

         public function __construct(ForgotPassword $model)
         {
             $this->model = $model;
         }

          /**
           * Find a Model
           * @param array $payload
           * @return Model
           */

         public function findCode($attribute, $value, $columns = array('*'), array $relations = ['user']): ?ForgotPassword
         {
            $model = $this->model->with($relations)->where('active', true)->where($attribute, '=', $value)->first($columns);
            return $model;
         }

    }

?>
