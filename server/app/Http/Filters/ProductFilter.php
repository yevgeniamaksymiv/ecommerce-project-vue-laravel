<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;


class ProductFilter extends AbstractFilter
{
    public const PRICE = 'price';
    public const SIZE = 'size';
    public const COLOR = 'color';
    public const CATEGORY_ID = 'category_id';

    protected function getCallbacks(): array
    {
        return [
            self::PRICE => [$this, 'price'],
            self::SIZE => [$this, 'size'],
            self::COLOR => [$this, 'color'],
            self::CATEGORY_ID => [$this, 'category_id'],
        ];
    }

    public function price(Builder $builder, string $value)
    {
        list($min, $max) = explode(",", $value);
        $builder->where('price', '>=', $min)
            ->where('price', '<=', $max);
    }

    public function size(Builder $builder, string $value)
    {
        $builder->where('size', $value);
    }

    public function color(Builder $builder, string $value)
    {
        $builder->where('color', $value);
    }

    public function category_id(Builder $builder, string $value)
    {
        $builder->where('category_id', $value);
    }
}
