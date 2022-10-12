<?php

namespace App\Dto\IwmsApi;

class IwmsApiPaginationResponseDto
{
    private int $currentPage;
    private int $totalPages;
    private int $perPage;
    private array $results = [];

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     * @return $this
     */
    public function setCurrentPage(int $currentPage): self
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     * @return $this
     */
    public function setTotalPages(int $totalPages): self
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     * @return $this
     */
    public function setResults(array $results): self
    {
        $this->results = $results;
        return $this;
    }

    public static function createFromApiResponse(array $data): self
    {
        return (new self())
            ->setCurrentPage($data['_meta']['currentPage'])
            ->setTotalPages($data['_meta']['pageCount'])
            ->setPerPage($data['_meta']['perPage'])
            ->setResults($data['results']);
    }
}
