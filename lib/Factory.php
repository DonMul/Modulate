<?php

namespace Modulate;

use Modulate\Collection\Action;
use Modulate\Collection\Filter;
use Modulate\Collection\Module;

/**
 * Class Factory
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
final class Factory
{
    /**
     * The singleton instance of this factory.
     *
     * @var Factory
     */
    private static $instance;

    /**
     * The collection of registered modules.
     *
     * @var Module
     */
    private $modules;

    /**
     * An associative array with the key being the name of the filter trigger and the value being a Filter collection.
     *
     * @var Filter[]
     */
    private $filters;

    /**
     * An associative array with the key being the name of the action trigger and the value being a Action collection.
     *
     * @var Action[]
     */
    private $actions;

    /**
     * Returns the singleton instance of the Modulate Factory
     *
     * @return Factory
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof Factory)) {
            self::$instance = new Factory();
        }

        return self::$instance;
    }

    /**
     * Private constructor function in order to make sure this is only called via the getInstance function. This
     * constructor will initialise all attributes in this factory
     */
    private function __construct()
    {
        $this->modules = new Module();
        $this->filters = [];
        $this->actions = [];
    }

    /**
     * Registers a module to this factory instance.
     *
     * This function both adds the module to the registered modules and calls the register function on the given module
     * which in it's turn can register the module's filters and actions.
     *
     * @param   IModule $module The module to register
     *
     * @return  bool            Returns whether or not the registration of the given module has been completed
     *                          successfully.
     */
    public function registerModule(IModule $module) {
        $isSuccessfullyRegistered = false;

        if (!$this->modules->isInCollection($module)) {
            $this->modules->addModule($module);
            $module->register();
        }

        return $isSuccessfullyRegistered;
    }

    /**
     * Registers a filter to this Modulate factory instance.
     *
     * The given Filter is registered and is bound to the given filterTriggerName. When the filter with the given
     * filterTriggerName is called, the given filter should be executed.
     *
     * @param   string  $filterTriggerName  The name of the trigger the given filter should listen to.
     * @param   IFilter $filter             The instance of the filter that should be registered.
     *
     * @return bool                         Returns whether or not the given filter has been successfully registered.
     */
    public function registerFilter($filterTriggerName, IFilter $filter)
    {
        $isSuccessfullyRegistered = false;

        if (!isset($this->filters[$filterTriggerName])) {
            $this->filters[$filterTriggerName] = new Filter([]);
        }

        if (!$this->filters[$filterTriggerName]->isInCollection($filter)) {
            $this->filters[$filterTriggerName]->addFilter($filter);
            $isSuccessfullyRegistered = true;
        }

        return $isSuccessfullyRegistered;
    }

    /**
     * Registers an action to this Modulate factory instance.
     *
     * The given Action is registered and is bound to the given actionTriggerName. When an action with that name is
     * called, the given action should be called.
     *
     * @param   string  $actionTriggerName The name of the trigger the given action should listen to.
     * @param   IAction $action             The instance of the action that should be registered.
     *
     * @return bool
     */
    public function registerAction($actionTriggerName, IAction $action)
    {
        $isSuccessfullyRegistered = false;

        if (!isset($this->actions[$actionTriggerName])) {
            $this->actions[$actionTriggerName] = new Action([]);
        }

        if (!$this->actions[$actionTriggerName]->isInCollection($action)) {
            $this->actions[$actionTriggerName]->addAction($action);
            $isSuccessfullyRegistered = true;
        }

        return $isSuccessfullyRegistered;
    }

    /**
     * Triggers all filters that are registered to the given filterName.
     *
     * All triggered filters could possibly modify the given variable. After all filters are fired, the variable is
     * returned. This could be used, for example, for variable manipulation or validation.
     *
     * @param   string  $filterTriggerName  The name of the trigger that the registered filters should be listening to.
     * @param   mixed   $variable           The variable given that should be filtered.
     *
     * @return  mixed                       The, possibly modified, leftover variable after all filters have been done.
     */
    public function triggerFilter($filterTriggerName, $variable)
    {
        if (!isset($this->filters[$filterTriggerName])) {
            return $variable;
        }

        foreach ($this->filters[$filterTriggerName]->getFilters() as $filter) {
            $variable = $filter->filter($variable);
        }

        return $variable;
    }

    /**
     * Triggers all actions that are listening to the given actionTriggerName.
     *
     * All triggered actions could possibly modify the given parameters and could do some unexpected behaviour if you
     * implement them wrong. Normally the should do the action which they are designed to do and after all actions have
     * been triggered, the modified parameters are returned.
     *
     * @param   string  $actionTriggerName  The name of the trigger that the registered actions should be listening to.
     * @param   array   $parameters         The parameters for the specific actions.
     *
     * @return  array                       The, possibly modified, leftover parameters after all filters have been
     *                                      done.
     */
    public function triggerAction($actionTriggerName, $parameters)
    {
        if (!isset($this->actions[$actionTriggerName])) {
            return $parameters;
        }

        foreach ($this->actions[$actionTriggerName]->getActions() as $action) {
            call_user_func_array([$action, 'trigger'], $parameters);
        }

        return $parameters;
    }
}