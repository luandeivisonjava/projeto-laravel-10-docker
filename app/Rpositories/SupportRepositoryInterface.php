<?php

namespace App\Rpositories;

use App\DTO\Supports\CreateSupportDto;
use App\DTO\Supports\UpdateSupportDto;
use stdClass;

interface SupportRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 10,string $filter = null): PaginationInterface;
    public function getAll(string $filter = null) : array;
    public function findOne(string $id) : stdClass | null;
    public function delete(string $id) : void;
    public function new(CreateSupportDto $dto) : stdClass;
    public function update(UpdateSupportDto $dto) : stdClass | null;
}
