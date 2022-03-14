<?php

    namespace App\Repository\Eloquent;
    use App\Models\Gallery;
    use App\Repository\GalleryRepositoryInterface;

    class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
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

         public function __construct(Gallery $model)
         {
             $this->model = $model;
         }

         public function insert(array $payload): ?bool
         {
             return $this->model->insert($payload);
         }

    }

?>
