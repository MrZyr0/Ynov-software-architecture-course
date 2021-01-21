# My software architecture course at Ynov

Here are all my notes and demonstration code of the different design patterns seen in class.

**Languages**: [:us:](readme.md) | [:fr:](readme_FR-fr.md)

## Software Architecture Cheat Sheet

**Navigation**

- [Software Architecture Cheat Sheet](#software-architecture-cheat-sheet)
    - [Global concepts](#global-concepts)
        - [Utils](#utils)
        - [Helpers](#helpers)
    - [Oriented Object concepts](#oriented-object-concepts)
        - [Classes](#classes)
            - [Immutable](#immutable)
            - [Abstract](#abstract)
                - [Abstract functions](#abstract-functions)
        - [Traits](#traits)
        - [Singleton](#singleton)
        - [Interfaces](#interfaces)
        - [Entities](#entities)
        - [Factories](#factories)
        - [Managers](#managers)
        - [Types](#types)
        - [Adapter](#adapter)
        - [Decorator](#decorator)
        - [Auto load - PHP](#auto-load---php)
            - [Setting it up](#setting-it-up)
    - [Sources](#sources)

### Global concepts

There are overarching project concepts that should apply to any project typology.

#### Utils

A utility is a piece of code that is reusable in any project to perform repeated actions. An abstract class in an
object-oriented project with only static functions, utilities are said to be "stateless". This meaning that they do not
store any data. They only used to perform an action / process data.

#### Helpers

A "helper" is a bit like a utility. It is a piece of code that is used in a project to make repeated actions that cannot
be classified in other concepts. Abstract class in an oriented project which can be "stateful" (but most of the time is
not), they are used to performing a / action. process project-specific data.
**Helpers are specific to a project, so they are not reusable across different projects, unlike utilities**.

---

### Oriented Object concepts

#### Classes

A class groups together a set of methods and properties that make up an object. It is a kind of specification sheet of
this one.

A class can also have methods and class properties, declared `static'. This allows to use them without have to
instantiate an object from this class or share data between all instantiated objects of this class.

**Example:**

```php
class ExampleClass {

}
```

##### Immutable

A class is immutable if it is not possible to modify the properties of the object after its instantiation, it does not
have a setter. The only way to have an object of this same class with other data is to create a new instance. Either
manually or via a function provided by the class.

**Example:**

```php
class ImmutableExampleClass {
    /**
     * Example of immutable property 
     * @var string
     */
    private string $immutablePropertyExample;
    
    /**
     * ImmutableExampleClass constructor.
     * 
     * @param string $immutablePropertyExample
     */
    public function __construct(string $immutablePropertyExample) {
        $this->immutablePropertyExample = $immutablePropertyExample;
    }
    
   /**
    * Example of immutable property 
    * @return string
    */
    public  function getImmutablePropertyExample(): string{
        return $this->immutablePropertyExample;
    }
    
    public function getOutput(): string {
        return $this->immutablePropertyExample . ' of some process';
    }
    
    /**
     * Function to create a new object form this immutable class with an additional string
     * 
     * @param string $immutablePropertyExample
     * @return ImmutableExampleClass
     */
    public function createNew(string $immutablePropertyExample):ImmutableExampleClass {
        return new ImmutableExampleClass($this->immutablePropertyExample . ' ' . $immutablePropertyExample);
    }
}

$immutableObject = new ImmutableExampleClass('Example');
$immutableObject->getOutput();

$newImmutableObject = new ImmutableExampleClass($immutableObject->getImmutablePropertyExample() . '2');
// OR
$newImmutableObject = $immutableObject->createNew('2');
```

##### Abstract

Declared with the keyword `abstract`, an abstract class is not instantiable, you can't use the keyword `new' on this
class. This allows to create parent classes that bring together the logic common to several classes without having to
duplicate it. The classes children automatically have the mother classes available, **except for abstract functions**.

**Example:**

```php
abstract class ExampleAbstractClass {

}
```

###### Abstract functions

Abstract functions allow you to create a contract with the child classes to ensure that they implement a function, such
as an interface. This can be useful when there is only one function to implement, it avoids a interface declaring a
single function.

Abstract functions have an additional advantage because they can be "protected"!
This means that you can declare an abstract function used in a "classical" function of the class.

**Example:**

```php
abstract class ExampleClass {
    abstract public function exampleAbstractPublicFunction();
    abstract protected function exampleAbstractProtectedFunction();
}
```

#### Traits

Traits are like mixins in **Sass** or **VueJs**, this allows to extract pieces of class features to avoid code
duplication.

**Example:**

```php
trait ExampleTrait {
   /**
    * Example trait property
    * 
    * @var string
    */
   public string $exampleTraitProperty;
   
   /**
    * Example trait property getter
    * 
    * @return string
    */
    public function getExampleTraitProperty():string {
        return $this->exampleTraitProperty;
   }
   
   /**
    * Example trait property setter
    * 
    * @param $value
    * @return self
    */
    public function setExampleTraitProperty($value) {
      $this->exampleTraitProperty = $value;
      
      return $this;
   }
}
```

#### Singleton

The `singleton` is a development concept to ensure that a class is instantiated only once time during the execution of
the project.

**Example:**

```php
class SingletonExampleClass
{
    /**
     * Singleton instance storage property
     * 
     * @var Object
     */
    private static Object $singleton_instance;

    /**
     * Example singleton getter
     * 
     * @return object
     */
    public static function getSingleton():object
    {
        if (self::$singleton_instance == null) {
            self::$singleton_instance = (object) 'Example';
        }
        return self::$singleton_instance;
    }
}
```

#### Interfaces

Allows you to create a contract with the classes. All classes that implement an interface have the obligation to
implement the functions declared in this interface. The functions declared in an interface are necessarily public
because the reverse is not useful. The objective is to be able to guarantee that the object we have has implemented
certain methods whatever the class.

**Example:**

```php
interface ExampleInterface {
    /**
     * Example of method signature declared in interface
     * 
     * @return mixed
     */
    public function exampleMustImplementedFunction();
}
```

#### Entities

An entity is a class that is necessarily instantiable because it is linked to an object in the business logic of the
project.

**Example:**

```php
class User {
   /**
    * Username property
    * 
    * @var string username
    */
   public string $username;
   
   /**
    * User constructor.
    *
    * @param string $username
    */
   public function __construct(string $username) {
    $this->username = $username;
   }
   
   /**
    * Username Getter
    * 
    * @return string
    */
   public function getUsername():string {
       return $this->username;
   }
   
   /**
    * @param string $username
    * @return string
    */
   public function setUsername(string $username):string {
    $this->username = $username;
    return $this->username;
   }
}
```

#### Factories

A factory allows you to create objects programmatically. This is useful when you want to instantiate the right class
among children of a parent class conditionally and apply treatment to the object before use.

#### Managers

A manager is a helper specific to an entity. This allows to separate the processing logic of an entity from more global
processing.

#### Types

Allows you to link values and constants. This improves the readability and security of the code.

**Example:**

```php
// Declare it
class ExampleType {
   const OK = 1;
   const NO = 2;
}

// Use it
class ExampleClass {
    public int $index = ExampleType::OK;
}
```


#### Auto load - PHP

Autoload is a very handy tool that allows you to replace `require` and include files automatically. This tool is based
on a Namespace that corresponds to the file path from the root of the sources declared in the
`composer.json` config file.

##### Setting it up

1. To start you must have initialized composer.
   ```shell
   composer init
   ```

2. Then you have to declare the auto-load parameters. To do this you need to add the following configuration to the
   file `composer.json`.
   ```json
   "autoload": {
       "psr-4": {
           "App\\" : "src/"
       }
   },
   ```
   `App\\` corresponds to the namespace root and `src/` to the resolution of this namespace for the source root folder.

3. In order for it to work, you must ask to composer to generate the necessary files.
   `composing dump-autoload`
   This will generate a `vendor` directory **that should not be committed because it is useless**.

## Sources

- [Teacher's repository](https://github.com/ld-web/ynov-masters-rappel-objet)
- [Wikipedia - Class](https://en.wikipedia.org/wiki/Class_(computer_programming))
- [Wikipedia - Helper Class](https://en.wikipedia.org/wiki/Helper_class)
- [Wikipedia - Singleton](https://en.wikipedia.org/wiki/Singleton_pattern)
- [Wikipedia - Interface](https://en.wikipedia.org/wiki/Protocol_(object-oriented_programming))
- [Wikipedia - Factory](https://en.wikipedia.org/wiki/Factory_%28object-oriented_programming%29)
