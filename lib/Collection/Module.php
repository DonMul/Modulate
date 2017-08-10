<?php

namespace Modulate\Collection;

use Modulate\IModule;

/**
 * Class Module
 *
 * This class is used for storing a collection of Modules which can be used for various purposes.
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
final class Module
{
    /**
     * The array containing all Modules registered to this collection.
     *
     * @var IModule[]
     */
    private $modules = [];

    /**
     * Module constructor.
     *
     * @param   IModule[] $modules
     */
    public function __construct($modules = [])
    {
        foreach ($modules as $module) {
            $this->addModule($module);
        }
    }

    /**
     * Adds the given Module to the internal collection. The key in the internal collection is based on the name of the
     * given Module.
     *
     * @param   IModule $module The Module to add to the internal collection
     */
    public function addModule(IModule $module)
    {
        $this->modules[$module->getName()] = $module;
    }

    /**
     * Returns all Modules within this collection.
     *
     * @return  IModule[]
     */
    public function getActions()
    {
        return $this->modules;
    }

    /**
     * Returns whether or not the given Module is within the current collection
     *
     * @param IModule $module The Module to check for in this collection.
     * @return bool
     */
    public function isInCollection(IModule $module)
    {
        return isset($this->modules[$module->getName()]);
    }
}