<?php


namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


abstract class QueryFilters {

    protected $queryFilters = [];// array with filter params, which could be added for pagination

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;
    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (! method_exists($this, $name)) {
                continue;
            }
            if (strlen($value)) {
                $this->$name($value);
                $this->queryFilters[$name] = $value;
            } else {
                $this->queryFilters[$name] = '';
            }
        }
        return $this->builder;
    }
    /**
     * Get all request filters data.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }

    /*
     * get string with parameters, which needed for correct sort
     */
    public function getPreparedQueryString()
    {
        // ?order={{$orderByFieldName}}&sort={{$sort}}
        if (empty($this->filters())) {
            return "";
        }

        $string = "";
        foreach ($this->filters() as $name => $value) {
            // for future - immediately check
            if (!is_array($value)) {
                //
                $string .= $name.'='.$value."&";
            }
        }
        return $string;
    }

    /**
     *
     * Get the array, which can be transformed into string with needed get-parameters
     * for filtering
     *
     * @return array
     */
    public function getQueryFilterParams()
    {
        return $this->queryFilters;
    }

}