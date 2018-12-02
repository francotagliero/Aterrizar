<?php

namespace App\FlightSearch;

use App\Flight;
use Illuminate\Http\Request;

class FlightSearch
{
    public static function apply(Request $filters)
    {
        $flight = (new Flight)->newQuery();

        // desde
        if ($filters->has('city_from')) {
            $flight->where('city_from', $filters->input('city_from'));
        }

        // hasta
        if ($filters->has('city_to')) {
            $flight->where('city_to', $filters->input('city_to'));
        }

        // fecha
        if ($filters->has('date')) {
            $flight->where('date', $filters->input('date'));
        }

        //agregar filtros que faltan

        // Get the results and return them.
        return $flight->get(); 
    }

    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {

            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }

        }
        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . studly_case($name);
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    private static function getResults(Builder $query)
    {
        return $query->get();
    }
}
