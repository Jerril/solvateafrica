<?php

    namespace App\Repository;

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;

    interface EloquentRepositoryInterface
    {
        /**
         * Get all Models
         *
         * @param array $columns
         * @param array $relations
         * @return Collection
         */

         public function all(array $columns = ['*'], array $relations = []): Collection;

        /**
         * Get all Models by condition
         *
         * @param array $columns
         * @param array $relations
         * @return Collection
         */
         public function collectionbycondition(array $payload, array $columns = ['*'], array $relations = []): Collection;

         /**
          * Create a model
          * @param array $payload
          * @return Model
          */
          public function create(array $payload): ?Model;

          /**
           *  Update existing Model
           * @param array $payload
           * @return bool
           */
          public function update(int $modelId, array $payload): ?Model;

          /**
           *  Delete model by id
           * @param int $modelId
           * @return bool
           */

          public function deleteById(int $modelId): bool;

           /**
           *  View model by id
           * @param int $modelId
           * @return bool
           */

          public function show(int $modelId): ?Model;


           /**
           *  View model by id
           * @param int $modelId
           * @return Model
           */

          public function find($modelId): ?Model;



    }

?>
