<?php

namespace Modulate\Base;

use Modulate\Collection\Action;
use Modulate\Collection\Filter;
use Modulate\Exception;
use Modulate\Factory;
use Modulate\IModule;

/**
 * Class Module
 *
 * This class can be used as optional base Module class which contains some helper functionality you will probably need
 * in the Module you are implementing.
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
abstract class Module implements IModule
{
    /**
     * Returns the name of this Module, based on the name of the instance of this class. This function uses
     * get_called_class() to determine that name.
     *
     * @return string
     */
    public function getName()
    {
        return get_called_class();
    }

    /**
     * Registers this module and all filters and actions that belong to it.
     *
     * @throws Exception\Action\UnableToRegister
     * @throws Exception\Filter\UnableToRegister
     */
    public function register()
    {
        $factory = Factory::getInstance();

        foreach ($this->getFiltersToRegister() as $triggerName => $filterCollection) {
            foreach ($filterCollection->getFilters() as $filter) {
                $hasBeenRegistered = $factory->registerFilter($triggerName, $filter);

                if (!$hasBeenRegistered) {
                    throw new Exception\Filter\UnableToRegister($filter);
                }
            }
        }

        foreach ($this->getActionsToRegister() as $triggerName => $actionCollection) {
            foreach ($actionCollection->getActions() as $action) {
                $hasBeenRegistered = $factory->registerAction($triggerName, $action);

                if (!$hasBeenRegistered) {
                    throw new Exception\Action\UnableToRegister($action);
                }
            }
        }
    }

    /**
     * Returns an associative array with the keys being the filter trigger name and the values being a Collection\Filter
     * object.
     *
     * These filters are all filters that are being registered by this module.
     *
     * @return Filter[]
     */
    public abstract function getFiltersToRegister();

    /**
     * Returns an associative array with the keys being the action trigger name and the values being a Collection\Action
     * object.
     *
     * These actions are all actions that are being registered by this module.
     *
     * @return Action[]
     */
    public abstract function getActionsToRegister();
}