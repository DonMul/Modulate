<?php

namespace Modulate;

/**
 * Interface IAction
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
interface IAction
{
    /**
     * Returns the name of this Action.
     *
     * @return  string
     */
    public function getName();

    /**
     * Triggers this action.
     *
     * @param   array ...$parameters    The collection of parameters used for this Action
     * @return  mixed
     */
    public function trigger(...$parameters);
}