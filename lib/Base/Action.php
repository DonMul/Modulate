<?php

namespace Modulate\Base;

use Modulate\IAction;

/**
 * Class Action
 *
 * This class can be used as optional base Action class which contains some helper functionality you will probably need
 * in the Action you are implementing.
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
abstract class Action implements IAction
{
    /**
     * Returns the name of this Action, based on the name of the instance of this class. This function uses
     * get_called_class() to determine that name.
     *
     * @return string
     */
    public function getName()
    {
        return get_called_class();
    }
}