<?php

namespace Modulate\Collection;

use Modulate\IAction;

/**
 * Class Action
 *
 * This class is used for storing a collection of Actions which can be used for various purposes.
 *
 * @package Modulate
 * @author Joost Mul <modulate@jmul.net>
 */
final class Action
{
    /**
     * The array containing all actions registered to this collection.
     *
     * @var IAction[]
     */
    private $actions = [];

    /**
     * Filter constructor.
     *
     * @param   IAction[] $actions
     */
    public function __construct($actions = [])
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }
    }

    /**
     * Adds the given Action to the internal collection. The key in the internal collection is based on the name of the
     * given action.
     *
     * @param   IAction $action The Action to add to the internal collection
     */
    public function addAction(IAction $action) {
        $this->actions[$action->getName()] = $action;
    }

    /**
     * Returns all Actions within this collection.
     *
     * @return  IAction[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Returns whether or not the given Action is within the current collection
     *
     * @param IAction $action   The Action to check for in this collection.
     * @return bool
     */
    public function isInCollection(IAction $action)
    {
        return isset($this->actions[$action->getName()]);
    }
}