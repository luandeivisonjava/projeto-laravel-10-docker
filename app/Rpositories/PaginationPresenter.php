<?php

namespace App\Rpositories;

use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class PaginationPresenter implements PaginationInterface
{
    /**
     * @var stdClass[]
     */
    private array $items;

    public function __construct(
        protected LengthAwarePaginator $paginator,
    ){
        $this->items = $this->resolveItems($this->paginator->items());
    }

    /**
     * @return int
     */

    public function currentPage(): int {
        return $this->paginator->currentPage() ?? 1;
    }

    /**
     * @return int
     */
    public function getNumberNextPage(): int {
        return $this->paginator->currentPage()+1;
    }

    /**
     * @return int
     */
    public function getNumberPreviousPage(): int {
        return $this->paginator->currentPage()-1;
    }

    /**
     * @return bool
     */
    public function isFirstPage(): bool {
        return $this->paginator->onFirstPage();
    }

    /**
     * @return bool
     */
    public function isLastPage(): bool {
        return $this->paginator->currentPage() === $this->paginator->lastPage();
    }

    /**
     * @return stdClass
     */
    public function items(): array {
        return $this->items;
    }

    /**
     * @return int
     */
    public function total(): int {
        return $this->paginator->total() ?? 1;
    }

    private function resolveItems(array $items): array {
        $response = [];
        foreach ($items as $item) {
            $stdClassObject = new stdClass();
            foreach($item->toArray() as $key => $value) {
                $stdClassObject->{$key} = $value;
            }
            array_push($response, $stdClassObject);
    }
    return $response;
    }
}
