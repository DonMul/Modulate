<?php

namespace Modulate\Base;

use Modulate\IFilter;

/**
 * Class Filter
 *
 * This class can be used as optional base Filter class which contains some helper functionality you will probably need
 * in the Filter you are implementing.
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
abstract class Filter implements IFilter
{
    /**
     * Returns the name of this Filter, based on the name of the instance of this class. This function uses
     * get_called_class() to determine that name.
     *
     * @return string
     */
    public function getName()
    {
        return get_called_class();
    }
}