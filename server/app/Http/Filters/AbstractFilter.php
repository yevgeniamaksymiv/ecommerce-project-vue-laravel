<?php
//
//
//namespace App\Http\Filters;
//
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Http\Request;
//
// abstract class QueryFilter
//{
//     /**
//      * @var Request
//      */
//     protected $request;
//
//     /**
//      * @var Builder
//      */
//     protected $builder;
//
//     /**
//      * @param Request $request
//      */
//     public function __construct(Request $request)
//     {
//         $this->request = $request;
//     }
//
//     /**
//      * @param Builder $builder
//      */
//     public function apply(Builder $builder)
//     {
//         $this->builder = $builder;
//
//         foreach ($this->fields() as $field => $value) {
//             $method = camel_case($field);
//             if (method_exists($this, $method)) {
//                 call_user_func_array([$this, $method], (array)$value);
//             }
//         }
//     }
//
//     /**
//      * @return array
//      */
//     protected function fields(): array
//     {
//         return array_filter(
//             array_map('trim', $this->request->all())
//         );
//     }
//
//}


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    /** @var array */
    private $queryParams = [];

    /**
     * AbstractFilter constructor.
     *
     * @param array $queryParams
     */
    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    abstract protected function getCallbacks(): array;

    public function apply(Builder $builder)
    {
        $this->before($builder);

        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                call_user_func($callback, $builder, $this->queryParams[$name]);
            }
        }
    }

    /**
     * @param Builder $builder
     */
    protected function before(Builder $builder)
    {
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * @param string[] $keys
     *
     * @return AbstractFilter
     */
    protected function removeQueryParam(string ...$keys)
    {
        foreach ($keys as $key) {
            unset($this->queryParams[$key]);
        }

        return $this;
    }
}

