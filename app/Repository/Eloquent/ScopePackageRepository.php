<?php

    namespace App\Repository\Eloquent;
    use App\Models\Scopepackage;
    use App\Repository\ScopePackageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ScopePackageRepository extends BaseRepository implements ScopePackageRepositoryInterface
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

         public function __construct(Scopepackage $model)
         {
             $this->model = $model;
         }

         public function GetScope(array $payload): Collection
         {
             return $this->model->where($payload)->get();
         }



    }

?>
