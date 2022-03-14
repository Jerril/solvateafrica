<?php

    namespace App\Repository;

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;

interface GiGRepositoryInterface extends EloquentRepositoryInterface {

        public function findWithTags(int $id, array $relations): ?Model;
    }

?>
