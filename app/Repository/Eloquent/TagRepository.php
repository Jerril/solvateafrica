<?php
    namespace App\Repository\Eloquent;
    use App\Models\Tag;
    use App\Repository\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function TagMassInsertion(array $payload, int $gigId): bool
    {
        foreach($payload as $tag)
            $tags[] = array('name' => $tag['tag'],
                            "gigId" => $gigId,
                            "userId" => auth()->user()->id,
                            "created_at" => now(),
                            "updated_at" => now());
        return $this->model->insert($tags);
    }
}
?>
