<?php

namespace Modulate\Exception\Action;

use Modulate\IAction;

/**
 * Class UnableToRegister
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
final class UnableToRegister extends \Exception
{
    const CODE = 2;

    /**
     * UnableToRegister constructor.
     * @param IAction $action
     */
    public function __construct(IAction $action)
    {
        parent::__construct(
            "Could not register the '{$action->getName()}' action. This can be caused because it has already been registered.",
            self::CODE
        );
    }
}