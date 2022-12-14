<?php
declare(strict_types=1);

namespace PlaystationStoreApi\Query;

use PlaystationStoreApi\Enum\Category;
use PlaystationStoreApi\ValueObject\Pagination;
use PlaystationStoreApi\ValueObject\Sorting;

final class CatalogProducts
{
    protected string $categoryId;

    protected string $sha256Hash;

    protected Pagination $pagination;

    protected Sorting $sorting;

    public function __construct(Category $category, string $sha256Hash)
    {
        $this->categoryId = $category->getValue();
        $this->sha256Hash = $sha256Hash;
        $this->pagination = new Pagination(10);
        $this->sorting = new Sorting('productReleaseDate');
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function setCategoryId(string $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function sha256Hash(): string
    {
        return $this->sha256Hash;
    }

    public function pagination(): Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): self
    {
        $this->pagination = $pagination;

        return $this;
    }

    public function sorting(): Sorting
    {
        return $this->sorting;
    }

    public function setSorting(Sorting $sorting): self
    {
        $this->sorting = $sorting;

        return $this;
    }
}
