<?php

    namespace App\Repository\Eloquent;

    use App\Repository\GigquestionRepositoryInterface;
    use App\Models\Gigquestion;

    class GigquestionRepository extends BaseRepository implements GigquestionRepositoryInterface
    {

        /**
         * @var Model
         */
        protected $model;

        public function __construct(Gigquestion $model)
        {
            $this->model = $model;
        }
    }
?>
