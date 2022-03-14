<?php

    namespace App\Repository\Eloquent;
    use App\Repository\TaskRepositoryInterface;
    use App\Models\Task;


    class TaskRepository extends BaseRepository implements TaskRepositoryInterface
    {
        protected $model;
        public function __construct(Task $model)
        {
            $this->model = $model;
        }

    }

?>
