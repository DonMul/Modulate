<?php

namespace Modulate;

/**
 * Interface IModule
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
interface IModule
{
    /**
     * Returns the name of this Module.
     *
     * @return  string
     */
    public function getName();

    /**
     * Registers this module and all filters and actions that belong to it.
     */
    public function register();
}