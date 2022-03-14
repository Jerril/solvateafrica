<?php

    namespace App\Repository\Eloquent;
    use App\Repository\ProjectManagementRepositoryInterface;
    use Illuminate\Database\Eloquent\Collection;
    use App\Models\Project;
    use Config;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectManagementRepository extends BaseRepository implements ProjectManagementRepositoryInterface
    {
        protected $model;
        public function __construct(Project $model)
        {
            $this->model = $model;
        }

        public function GetProjects(int $userId): LengthAwarePaginator
        {
            return $this->model->where('userId',$userId)->paginate(15);
        }

        public function GetProjectsByUser(int $userId): LengthAwarePaginator
        {
            return $this->model->where('userId',$userId)->orWhere('observerId',$userId)->paginate(15);
        }

        public function GetProjectsByTrackedOrderId(int $trackedOrderId): LengthAwarePaginator
        {
            return $this->model->where('tracked_order_id',$trackedOrderId)->paginate(15);
        }
    }

?>
