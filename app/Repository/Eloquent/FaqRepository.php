<?php
    namespace App\Repository\Eloquent;

use App\Models\Faq;
use App\Repository\FaqRepositoryInterface;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    /**
     *  @var Model
     */
    protected $model;

    public function __construct(Faq $model)
    {
        $this->model = $model;
    }
}
?>
