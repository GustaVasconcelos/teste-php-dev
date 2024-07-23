<?php

namespace App\Utils;

use App\Exceptions\ItemNotFoundException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class RepositoryHelper
{
    public function findByIdOrFail(BaseRepository $repository, string $model, int $id): Model
    {
        $item = $repository->findById($id);

        if (!$item) {
            throw new ItemNotFoundException($model . ' não encontrado');
        }

        return $item;
    }
}
