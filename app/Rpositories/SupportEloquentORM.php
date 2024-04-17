<?php
namespace App\Rpositories;

use App\DTO\Supports\CreateSupportDto;
use App\DTO\Supports\UpdateSupportDto;
use App\Models\Support;


use App\Rpositories\PaginationInterface;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface

{

    public function __construct(
            protected Support $model
        )
        {

        }


        public function paginate(int $page = 1, int $totalPerPage = 10,string $filter = null): PaginationInterface
        {
            $result = $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter){
                            $query->where('subject', $filter);
                            $query->orWhere('body','like','%'. $filter .'%');
                        }
                    })
                    ->paginate($totalPerPage,['*'],'page',$page);
                    return new PaginationPresenter($result);
        }
    /**
     *
     * @param string $id
     */
    public function delete(string $id): void {
        $this->model->findOrFail($id)->delete();
    }

    /**
     *
     * @param string $id
     * @return stdClass|null
     */
    public function findOne(string $id): stdClass|null {
        $support = $this->model->find($id);
        if(!$support){
            return null;
        }
        return (object) $support->toArray();

    }

    /**
     *
     * @param string|null $filter
     * @return array
     */
    public function getAll(string $filter = null): array {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter){
                            $query->where('subject', $filter);
                            $query->orWhere('body','like','%'. $filter .'%');
                        }
                    })
                    ->get()
                    ->toArray();
    }

    /**
     *
     * @param App\DTO\CreateSupportDto $dto
     * @return stdClass
     */
    public function new(CreateSupportDto $dto): stdClass {
        $support = $this->model->create(
            (array) $dto
        );
        return (object) $support->toArray();
    }

    /**
     *
     * @param App\DTO\UpdateSupportDto $dto
     * @return stdClass|null
     */
    public function update(UpdateSupportDto $dto): stdClass|null {
        if(!$support = $this->model->find($dto->id)){
            return null;
        }
        $support->update(
            (array) $dto
        );
        return (object) $support->toArray();
    }
}
