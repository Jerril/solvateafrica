<?php

    namespace App\Repository;

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;

    interface ScopePackageRepositoryInterface extends EloquentRepositoryInterface {

        public function GetScope(array $payload): Collection;

    }

?>
