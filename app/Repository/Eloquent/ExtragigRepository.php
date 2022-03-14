<?php

    namespace App\Repository\Eloquent;

    use App\Repository\ExtragigRepositoryInterface;
    use App\Models\Extragigservice;

class ExtragigRepository extends BaseRepository implements ExtragigRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Extragigservice $model)
    {
        $this->model = $model;
    }
}
?>
