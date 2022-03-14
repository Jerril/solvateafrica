<?php

    namespace App\Repository;

    use Illuminate\Database\Eloquent\Collection;

    interface GalleryRepositoryInterface extends EloquentRepositoryInterface {

        public function insert(array $payload): ? bool;

    }

?>
