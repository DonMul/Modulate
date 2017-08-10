<?php

namespace Modulate\Collection;

use Modulate\IFilter;

/**
 * Class Filter
 *
 * This class is used for storing a collection of Filters which can be used for various purposes.
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
final class Filter
{
    /**
     * @var IFilter[]
     */
    private $filters = [];

    /**
     * Filter constructor.
     *
     * @param   IFilter[]   $filters
     */
    public function __construct($filters = [])
    {
        foreach ($this->filters as $filter) {
            $this->addFilter($filter);
        }
    }

    /**
     * Adds the given Filter to the internal collection. The key in the internal collection is based on the name of the
     * given Filter.
     *
     * @param   IFilter $filter The Filter that should be added to this collection.
     */
    public function addFilter(IFilter $filter) {
        $this->filters[$filter->getName()] = $filter;
    }

    /**
     * Returns all Filters within this collection.
     *
     * @return  IFilter[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Returns whether or not the given Filter is within the current collection
     *
     * @param IFilter $filter   The Filter to check for in this collection.
     * @return bool
     */
    public function isInCollection(IFilter $filter)
    {
        return isset($this->filters[$filter->getName()]);
    }
}