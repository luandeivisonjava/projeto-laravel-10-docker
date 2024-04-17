<?php

namespace App\Rpositories;

interface PaginationInterface
{
public function items(): array;
public function total(): int;
public function isFirstPage(): bool;
public function isLastPage(): bool;
public function currentPage(): int;
public function getNumberPreviousPage(): int;
public function getNumberNextPage(): int;

}
