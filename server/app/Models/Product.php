<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\Filterable;

class Product extends Model
{
    use Filterable;

    protected $table = 'products';
    protected $guarded = false;

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getImagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => url('storage/'.$this->img_path)
        );
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'size',
        'color',
        'img_path',
        'category_id'
    ];
}
