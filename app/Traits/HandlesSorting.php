<?php

namespace App\Traits;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait HandlesSorting
{
    protected function applySorting($query, string $sortBy, string $sortDirection, array $sortableFields): void
    {
        if (isset($sortableFields[$sortBy])) {
            $sortableFields[$sortBy]($query, $sortDirection);
        } else {
            $defaultField = array_key_first($sortableFields) ?? 'id';
            if (isset($sortableFields[$defaultField])) {
                $sortableFields[$defaultField]($query, $sortDirection);
            } else {
                $query->orderBy('id', $sortDirection);
            }
        }
    }

    protected function getFilters(Request $request): Collection
    {
        $filter = $request->query('filter', []);
        return collect([
            'search' => $filter['search'] ?? '',
            'number_rows' => $filter['number_rows'] ?? 10,
            'sort_by' => $filter['sort_by'] ?? 'id',
            'sort_direction' => $filter['sort_direction'] ?? 'desc',
            'start_date' => $filter['start_date'] ?? null,
            'end_date' => $filter['end_date'] ?? null,
            'branch_id' => $filter['branch_id'] ?? null,
            'category_id' => $filter['category_id'] ?? null,
            'hashtag_ids' => $filter['hashtag_ids'] ?? null,
        ]);
    }

    protected function applySortingToQuery($query, string $sortBy, string $sortDirection, array $sortableFields): void
    {
        $this->applySorting($query, $sortBy, $sortDirection, $sortableFields);
    }

    protected function simpleSort(string $column): \Closure
    {
        return function ($query, $direction) use ($column) {
            $query->orderBy($column, $direction);
        };
    }

    protected function relatedSort(string $modelClass, string $selectColumn, string $whereColumn, string $parentColumn): Closure
    {
        return function ($query, $direction) use ($modelClass, $selectColumn, $whereColumn, $parentColumn) {
            $query->orderBy(
                $modelClass::select($selectColumn)->whereColumn($whereColumn, $parentColumn),
                $direction
            );
        };
    }

    protected function complexSort(string $modelClass, string $selectColumn, array $joins, string $whereColumn, string $parentColumn): \Closure
    {
        return function ($query, $direction) use ($modelClass, $selectColumn, $joins, $whereColumn, $parentColumn) {
            $subQuery = $modelClass::select($selectColumn);

            foreach ($joins as $join) {
                $subQuery->join($join[0], $join[1], $join[2], $join[3]);
            }

            $query->orderBy(
                $subQuery->whereColumn($whereColumn, $parentColumn)->limit(1),
                $direction
            );
        };
    }
}