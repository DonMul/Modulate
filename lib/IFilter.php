<?php

namespace Modulate;

/**
 * Interface IFilter
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
interface IFilter
{
    /**
     * Returns the name of this Filter.
     *
     * @return  string
     */
    public function getName();

    /**
     * Execute this filter.
     *
     * @param   mixed $variable The variable that should be filtered.
     * @return  mixed
     */
    public function filter($variable);
}