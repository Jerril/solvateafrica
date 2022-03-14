<?php

    namespace App\Repository\Eloquent;

    use App\Repository\EloquentRepositoryInterface;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\QueryException;

    class BaseRepository implements EloquentRepositoryInterface
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

         public function __construct(Model $model)
         {
             $this->model = $model;
         }

         /**
          * @param array $columns
          * @param array $relations
          * @return Collection
          */
          public function all(array $columns = ['*'], array $relations = []): Collection
          {
              return $this->model->with($relations)->get($columns);
          }

          /**
          * @param array $columns
          * @param array $relations
          * @return Collection
          */
          public function collectionbycondition(array $payload, array $columns = ['*'], array $relations = []): Collection
          {
              return $this->model->with($relations)->where($payload)->get($columns);
          }

          /**
           * Create a Model
           * @param array $payload
           * @return Model
           */

           public function create(array $payload): ?Model
           {
               $model = $this->model->create($payload);
               return $model->fresh();
           }

           /**
           * Update a Model
           * @param array $payload
           * @return Model
           */
          public function update(int $modelId, array $payload): ?Model
          {
            $model = $this->model->find($modelId)->update($payload);
            return $this->model->find($modelId);
          }

           /**
           * Delete a Model
           * @param array $payload
           * @return bool
           */

          public function deleteById(int $modelId): bool
          {
            $model = $this->model->find($modelId);
            return $model->delete();
          }

          /**
           * Show a Model
           * @param array $payload
           * @return bool
           */

          public function show(int $modelId): ?Model
          {
            $model = $this->model->findById($modelId);
            return $model->fresh();
          }

           /**
           * Find a Model
           * @param array $payload
           * @return Model
           */

          public function findOne($payload, $columns = array('*')): ?Model
          {
            $model = $this->model->where($payload)->first($columns);
            return $model;
          }

        /**
         * BaseRepository constructor
         *
         * @param Model $model
         */
        public function updateOrCreate(array $params, array $payload,array $relations = [], $columns = array('*')): ?Model
        {
          $model = $this->model->with($relations)->updateOrCreate($params, $payload);

          return $model;
        }


         /**
         * Find a Model
         * @param array $payload
         * @return Collection
         */

        public function GetById($attribute,$value,$relations = [], $columns = array('*')): ?Collection
        {
          $model = $this->model->with($relations)->where($attribute,'=', $value)->get($columns);
          return $model;
        }

         /**
         * Find a Model
         * @param int $modelId
         * @return Model
         */

          public function find($modelId): ?Model
          {
            $model = $this->model->find($modelId);
            return $model;
          }

    }


?>
