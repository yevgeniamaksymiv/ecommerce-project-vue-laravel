<?php
//
//
//namespace App\Http\Filters;
//
//use Illuminate\Database\Eloquent\Builder;
//
//trait Filterable
//{
//    /**
//     * @param Builder $builder
//     * @param QueryFilter $filter
//     */
//    public function scopeFilter(Builder $builder, QueryFilter $filter)
//    {
//        $filter->apply($builder);
//    }
//}


namespace App\Http\Filters;


use App\Http\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param FilterInterface $filter
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, FilterInterface $filter)
    {
        $filter->apply($builder);

        return $builder;
    }
}

