<?php


namespace App\Filters;


class ProductFilters extends QueryFilters 
{
    public function sort($sort)
    {
        return $this->builder->orderBy('name', $sort);
    }
}