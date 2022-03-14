<?php

    namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

    interface ProjectManagementRepositoryInterface extends EloquentRepositoryInterface {

        public function GetProjects(int $userId): LengthAwarePaginator;

        public function GetProjectsByUser(int $userId): LengthAwarePaginator;

        public function GetProjectsByTrackedOrderId(int $trackedOrderId): LengthAwarePaginator;
    }

?>
