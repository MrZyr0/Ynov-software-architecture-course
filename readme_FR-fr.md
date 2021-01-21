# Mon cours d'architecture logicielle à Ynov

Voici toutes mes notes et bout de code "démo" des différents modèles de conception "design pattern" vus en classe.

**Languages**: [:us:](readme.md) | [:fr:](readme_FR-fr.md)

## Software Architecture Cheat Sheet

**Navigation**
- [Software Architecture Cheat Sheet](#software-architecture-cheat-sheet)
    - [Global concepts](#global-concepts)
        - [Utilitaires ~ `Utils`](#utilitaires--utils)
        - [Aidant ~ `Helpers`](#aidant--helpers)
    - [Oriented Object concepts](#oriented-object-concepts)
        - [Classes ~ `class`](#classes--class)
            - [Classes immuables](#classes-immuables)
            - [Classes abstraites ~ `abstract class`](#classes-abstraites--abstract-class)
                - [Fonctions abstraites ~ `abstract function`](#fonctions-abstraites--abstract-function)
        - [`Traits`](#traits)
        - [Instance unique - `Singleton`](#instance-unique---singleton)
        - [Interfaces ~ `interfaces`](#interfaces--interfaces)
        - [Entités ~ `Entities`](#entités--entities)
        - [Usines ~ `Factories`](#usines--factories)
        - [Managers](#managers)
        - [Types](#types)
        - [Adaptateur](#adaptateur)
        - [Décorateur](#décorateur)
        - [Auto load - PHP](#auto-load---php)
            - [Mise en place](#mise-en-place)
    - [Sources](#sources)


### Global concepts

Il existe des concepts de projet globaux qui peuvent s'appliquer à toute typologie de projet.

#### Utilitaires ~ `Utils`

Un utilitaire est un morceau de code réutilisable dans n'importe quel projet pour effectuer des actions répétées. Une
classe abstraite avec seulement des fonctions statiques dans un projet orienté objet, les utilitaires sont dits
"stateless". Cela signifie qu'ils ne stockent pas de données. Ils ne servent qu'à effectuer une action ~ traiter des
données.

#### Aidant ~ `Helpers`

Un "helper" est un peu comme un utilitaire. C'est un morceau de code qui est utilisé dans un projet pour effectuer des
actions répétées et ne qui ne peut être classé dans d'autres concepts. Classe abstraite dans un projet orienté objet,
pouvant être "stateful" (mais la plupart du temps ne l'est pas), ils sont utilisés pour effectuer une action ~ traiter
des données spécifiques à un projet.
**Les aides sont spécifiques à un projet, elles ne sont donc pas réutilisables entre différents projets, contrairement
aux services publics**.

---

### Oriented Object concepts

#### Classes ~ `class`

Une classe regroupe un ensemble de méthodes et de propriétés qui composent un objet. C'est une sorte de fiche de
spécification de celui-ci.

Une classe peux aussi avoir des méthodes et propriétés de classes, déclarées `static`. Celui permet de les utiliser sans
avoir à instancier un object depuis cette classe ou bien partager des données entre tous les objects instanciés de cette
classe.

**Example:**

```php
class ExampleClass {

}
```

##### Classes immuables

Une classe est immuable s'il n'est pas possible de modifier les propriétés de l'objet après son instanciation, il ne
possède pas de setter. La seule façon d'avoir un objet de cette même classe avec d'autre données, il faut une nouvelle
instance. Soit manuellement, soit via une fonction fournie par la classe.

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

##### Classes abstraites ~ `abstract class`

Déclaré avec le mot clé `abstract`, une classe abstraite n'est pas instantiable, on ne peux pas utiliser le mot
clé `new` sur cette classe. Cela permet de créer des classes mère qui rassemble la logique commune à plusieurs classes
sans avoir à la dupliqué. Les classes enfants ont automatiquement les classes mère de disponible, **sauf les fonctions
abstraites**.

**Example:**

```php
abstract class ExampleAbstractClass {

}
```

###### Fonctions abstraites ~ `abstract function`

Les fonctions abstraites permettent de créer un contrat avec les classes enfants afin de s'assurer qu'ils implémentent
une fonction, comme une interface. Cela peut être util lorsqu'il y a une seule fonction à implémenter, ça évite une
interface déclarant une seule fonction.

Les fonctions abstraites ont un avantage supplémentaire car elles peuvent être `protected` !\
Cela signifie que l'on peut déclarer une fonction abstraite utilisée dans une fonction "classique" de la class.

**Example:**

```php
abstract class ExampleClass {
    abstract public function exampleAbstractPublicFunction();
    abstract protected function exampleAbstractProtectedFunction();
}
```

#### `Traits`

Les `traits` sont comme des mixines en **Sass** ou **VueJs**, cela permet d'extraire des morceaux de caractéristiques de
classe pour éviter la duplication du code.

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

#### Instance unique - `Singleton`

Le `singleton` est un concept de développement afin de s'assurer qu'une classe n'est instanciée qu'une seule fois
pendant l'exécution du projet.

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

#### Interfaces ~ `interfaces`

Elles permettent de créer un contrat avec des classes. Toutes les classes qui implémentent une interface ont
l'obligation d'implémenter les fonctions déclarées dans cette même interface. Les fonctions déclarées dans une interface
sont nécessairement publiques car l'inverse n'est pas utile. L'objectif est de pouvoir garantir que l'objet que nous
avons a bien implémenté certaines méthodes quelle que soit sa classe.

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

#### Entités ~ `Entities`

Une entité est une classe nécessairement instantiable puisqu'elle est liée à un objet de la logique métier du projet.

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

#### Usines ~ `Factories`

Une usine vous permet de créer des objets programmatiquement. Cela est utile lorsque l'on veut instancier la bonne
classe parmi les enfants d'une classe parente conditionnellement et appliquer un traitement à l'objet avant utilisation.

#### Managers

Un manager est un assistant spécifique à une entité. Cela permet de séparer la logique de traitement d'une entité d'un
traitement plus global.

#### Types

Permet de relier des valeurs et des constantes. Cela améliore la lisibilité et la sécurité du code.

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

L'auto-load est un outil très pratique qui permet de remplacer les `require` pour inclure les fichiers automatiquement.
Cet outil se base sur un Namespace qui correspond au chemin du fichier depuis la racine des sources déclaré dans le
fichier `composer.json`.

##### Mise en place

1. Pour commencer il faut avoir initialisé composer.
   ```shell
   composer init
   ```

2. Ensuite il faut déclarer les paramètres de l'auto-load. Pour cela il faut ajouter la configuration suivante au
   fichier `composer.json`.
   ```json
   "autoload": {
       "psr-4": {
           "App\\" : "src/"
       }
   },
   ```
   `App\\` correspond au namespace racine et `src/` à la résolution de ce namespace pour le dossier racine des sources.

3. Afin pour que ça fonctionne il faut demander à composer de générer les fichiers nécessaires au fonctionnement.
   `composer dump-autoload`
   Cela va générer un dossier `vendor` qu'**il ne faut pas commit car cela est inutile**.

## Sources

- [Répertoire du professeur](https://github.com/ld-web/ynov-masters-rappel-objet)
- [Wikipedia - Classe](https://fr.wikipedia.org/wiki/Classe_(informatique))
- [Wikipedia - Singleton](https://fr.wikipedia.org/wiki/Singleton_(patron_de_conception))
- [Wikipedia - Interface](https://fr.wikipedia.org/wiki/Interface_(programmation_orientée_objet))
