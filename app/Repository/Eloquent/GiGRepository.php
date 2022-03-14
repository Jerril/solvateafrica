<?php

    namespace App\Repository\Eloquent;
    use App\Models\GiG;
    use App\Repository\GiGRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GiGRepository extends BaseRepository implements GiGRepositoryInterface
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

         public function __construct(GiG $model)
         {
             $this->model = $model;
         }

         public function findWithTags(int $id, array $relations): ?Model
         {
             return $this->model->with($relations)->find($id);
         }


    }

?>
