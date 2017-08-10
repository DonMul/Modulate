# Modulate
## What is modulate
Modulate is a PHP driven library which allows the use of a module based system. This system is based on filters and 
actions. The filters are used in order to manipulate a variable and possibly validate is, while the acions are used to
actually perform business logic.

## How do i use Modulate?
It is quite simple to use Modulate. Basically you will need to have a Module class and register it to the Modulate 
Factory. The code below will register a module (```FooModule```) with 1 filter (```FooFilter```) and 1 action 
(```FooAction```). Both the filter and the action will trigger when the barTrigger event in thrown.

```
class FooAction extends \Modulate\Base\Action
{
    public function trigger(...$parameters)
    {
        //  TODO: Implement trigger() method.
    }
}

class FooFilter extends \Modulate\Base\Filter
{
    public function filter($variable)
    {
        // TODO: Implement filter() method.
    }
}

class FooModule extends \Modulate\Base\Module
{
    public function getFiltersToRegister()
    {
        return [
            'barTrigger' => new \Modulate\Collection\Filter([
                new FooFilter()
            ])
        ];
    }

    public function getActionsToRegister()
    {
        return [
            'barTrigger' => new \Modulate\Collection\Action([
                new FooAction()
            ])
        ];
    }
}

$factory = \Modulate\Factory::getInstance();
$factory->registerModule(new FooModule());
```