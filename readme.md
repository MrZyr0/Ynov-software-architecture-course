# My software architecture course at Ynov

Here are all my notes and demonstration code of the different design patterns seen in class.

**Languages**: [:us:](readme.md) | [:fr:](readme_FR-fr.md)

## Software Architecture Cheat Sheet

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
   public string $exampleTraitProperty;
   
   public function getExampleTraitProperty() {
    return $this->exampleTraitProperty;
   }
   
   public function setExampleTraitProperty($value) {
      $this->exampleTraitProperty = $value;
      
      return $this->exampleTraitProperty;
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
    private static $singleton_instance = null;

    private function __construct()
    {
        // Constructor is useless here
    }

    public static function getSingleton()
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
    public function exampleMustImplementedFunction();
}
```

#### Entities

An entity is a class that is necessarily instantiable because it is linked to an object in the business logic of the
project.

**Example:**

```php
class User {
   public string $username;
   
   public function __construct($username) {
    $this->username = $username;
   }
   
   public function getUsername() {
    return $this->username;
   }
   
   public function setUsername(string $username) {
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