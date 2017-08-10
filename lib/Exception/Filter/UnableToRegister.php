<?php

namespace Modulate\Exception\Filter;

use Modulate\IFilter;

/**
 * Class UnableToRegister
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
final class UnableToRegister extends \Exception
{
    const CODE = 1;

    /**
     * UnableToRegister constructor.
     * @param IFilter $filter
     */
    public function __construct(IFilter $filter)
    {
        parent::__construct(
            "Could not register the '{$filter->getName()}' filter. This can be caused because it has already been registered.",
            self::CODE
        );
    }
}