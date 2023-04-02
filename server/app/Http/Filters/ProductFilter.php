<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;


class ProductFilter extends AbstractFilter
{
    public const PRICE = 'price';
    public const SIZE = 'size';
    public const COLOR = 'color';

    protected function getCallbacks(): array
    {
        return [
            self::PRICE => [$this, 'price'],
            self::SIZE => [$this, 'size'],
            self::COLOR => [$this, 'color'],
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
}
