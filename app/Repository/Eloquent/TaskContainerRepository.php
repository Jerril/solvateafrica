<?php

    namespace App\Repository\Eloquent;
    use App\Repository\TaskContainerRepositoryInterface;
    use App\Models\TaskContainer;


    class TaskContainerRepository extends BaseRepository implements TaskContainerRepositoryInterface
    {
        protected $model;
        public function __construct(TaskContainer $model)
        {
            $this->model = $model;
        }

    }

?>
