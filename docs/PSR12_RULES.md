# 📐 Règles PSR-12 et Standards PHP

## 🎯 Table des Matières

1. [C'est quoi PSR ?](#cest-quoi-psr)
2. [PSR-12 : Standards PHP](#psr-12-standards-php)
3. [Les Règles Principales](#les-règles-principales)
4. [Autres Standards (PSR-1, PSR-4, etc.)](#autres-standards)
5. [Pourquoi Suivre ces Standards ?](#pourquoi-suivre-ces-standards)

---

## 🤔 C'est quoi PSR ?

**PSR = PHP Standards Recommendations**

### Définition Simple

PSR sont des **règles** créées par la **PHP-FIG** (PHP Framework Interop Group).

**PHP-FIG** = Groupe de développeurs de frameworks PHP (Symfony, Laravel, CakePHP, etc.)

### Leur But

**Standardiser** le code PHP pour que :
- ✅ Tout le monde écrit de la même façon
- ✅ Le code est lisible par tous
- ✅ Collaboration facilitée
- ✅ Compatibilité entre frameworks

### Historique des PSR

```
PSR-0  → Autoloading (ancien, remplacé)
PSR-1  → Coding Standard (basique)
PSR-2  → Coding Style (ancien)
PSR-3  → Logger Interface
PSR-4  → Autoloading (moderne)
PSR-7  → HTTP Message Interface
PSR-12 → Coding Style (moderne, remplace PSR-2)
```

---

## 📋 PSR-12 : Standards PHP

### Vue d'Ensemble

**PSR-12** est l'extension de **PSR-1** qui définit le **style de code**.

Il remplace **PSR-2** (plus moderne et complet).

### Les Règles Principales

#### 1. **Longueur de Ligne (Line Length)**

```php
// ❌ TROP LONG (125 caractères)
$this->Html->tag('span', $this->Html->tag('i', '', ['class' => $icon]), ['class' => 'input-group-text']);

// ✅ CORRECT (< 120 caractères)
$this->Html->tag(
    'span',
    $this->Html->tag('i', '', ['class' => $icon]),
    ['class' => 'input-group-text']
);
```

**Règle :** Maximum **120 caractères** par ligne.

**Pourquoi ?**
- Lisible sur tous les écrans
- Pas de scroll horizontal
- Code reviews faciles

#### 2. **Indentation**

```php
// ❌ MAUVAIS (espaces mixtes)
function test(){
    $a = 1;
      $b = 2; // Incohérent
}

// ✅ BON (4 espaces)
function test(): void
{
    $a = 1;
    $b = 2; // Cohérent
}
```

**Règle :** Utiliser **4 espaces** (jamais de tabs).

**Pourquoi ?**
- Uniforme sur tous les éditeurs
- Indentation visible et prévisible

#### 3. **Types de Retour**

```php
// ❌ MAUVAIS (pas de type de retour)
function add($a, $b) {
    return $a + $b;
}

// ✅ BON (type de retour explicite)
function add(int $a, int $b): int {
    return $a + $b;
}
```

**Règle :** Toujours déclarer les **types de retour**.

**Pourquoi ?**
- PHP sait ce qui est attendu
- Erreurs détectées plus tôt
- IDE peut aider mieux

#### 4. **Guillemets Simples**

```php
// ❌ MAUVAIS (guillemets doubles)
$text = "Hello World";

// ✅ BON (guillemets simples)
$text = 'Hello World';
```

**Règle :** Utiliser des **guillemets simples** sauf pour les variables.

**Pourquoi ?**
- Plus rapide (pas d'interprétation)
- Moins de risques d'erreurs

#### 5. **Syntaxe Tableau Court**

```php
// ❌ MAUVAIS (ancien)
$arr = array('a', 'b', 'c');

// ✅ BON (moderne)
$arr = ['a', 'b', 'c'];
```

**Règle :** Utiliser la syntaxe courte `[]`.

**Pourquoi ?**
- Plus moderne (PHP 5.4+)
- Plus court à écrire
- Plus lisible

#### 6. **Namespace et Use**

```php
// ✅ BON (namespace en premier)
<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use Cake\Controller\Controller;

class UsersController extends Controller
{
    // ...
}
```

**Règle :**
1. `<?php` en première ligne
2. `declare(strict_types=1);` en deuxième ligne
3. **1 ligne vide**
4. `namespace`
5. **1 ligne vide**
6. `use` statements (triés alphabétiquement)
7. **1 ligne vide**
8. Classe

**Pourquoi ?**
- Ordre logique
- Facile à trouver les imports

#### 7. **Classes et Méthodes**

```php
// ✅ BON (structuration claire)
class UserController extends Controller
{
    public function index(): void
    {
        // Code ici
    }
    
    private function helperMethod(): string
    {
        // Code ici
        return 'result';
    }
}
```

**Règle :**
- **Classe** : accolade ouvrante `{` sur nouvelle ligne
- **Méthode** : accolade ouvrante `{` sur nouvelle ligne
- **Visibilité** : toujours déclarer `public`, `private`, ou `protected`

**Pourquoi ?**
- Cohérence dans tout le code
- Facile à identifier les sections

#### 8. **Opérateurs et Espaces**

```php
// ❌ MAUVAIS
$a=$b+$c;
if($a==$b){

// ✅ BON
$a = $b + $c;
if ($a == $b) {
```

**Règle :**
- Espacer les opérateurs : `=`, `+`, `-`, `*`, `/`, `==`, etc.
- Pas d'espace après les parenthèses ouvrantes : `if (` pas `if( `
- Pas d'espace avant les parenthèses fermantes : `) {` pas `)  {`

**Pourquoi ?**
- Plus lisible
- Évite les confusions

#### 9. **Multiligne (Array Arguments)**

```php
// ❌ MAUVAIS
$result = function($param1, $param2, $param3, $param4, $param5, $param6);

// ✅ BON
$result = function(
    $param1,
    $param2,
    $param3,
    $param4,
    $param5,
    $param6
);
```

**Règle :**
- Si ligne > 120 caractères, passer à la ligne
- Un argument par ligne
- Parenthèse fermante sur sa propre ligne

**Pourquoi ?**
- Plus facile à lire
- Différences facilement visibles (git diff)

#### 10. **Méthodes Châinées**

```php
// ❌ MAUVAIS
$obj->method1()->method2()->method3();

// ✅ BON (chaque méthode sur sa ligne)
$obj->method1()
    ->method2()
    ->method3();
```

**Règle :** Chaque appel sur une nouvelle ligne.

**Pourquoi ?**
- Facile à ajouter/supprimer des appels
- Plus facile à déboguer

---

## 🔄 Autres Standards

### PSR-1 : Coding Standard (Basique)

#### Règle 1 : Classes en PascalCase

```php
// ✅ BON
class UserController
class UserRepository
class EmailService

// ❌ MAUVAIS
class user_controller
class userController
class USER_CONTROLLER
```

#### Règle 2 : Méthodes en camelCase

```php
// ✅ BON
public function getUserById(): User
public function createNewUser(): void
public function validateEmail(): bool

// ❌ MAUVAIS
public function get_user_by_id()
public function GetUserById()
public function GET_USER_BY_ID()
```

#### Règle 3 : Constantes en MAJUSCULES

```php
// ✅ BON
class Config
{
    public const MAX_LOGIN_ATTEMPTS = 5;
    public const DEFAULT_TIMEOUT = 30;
    private const SECRET_KEY = 'abc123';
}

// ❌ MAUVAIS
public const max_login_attempts = 5;
public const defaultTimeout = 30;
```

### PSR-4 : Autoloading (Automatique)

#### Règle : Namespace = Structure de Dossiers

```
projet/
├── src/
│   ├── App/
│   │   ├── Controller/
│   │   │   └── UsersController.php
│   │   └── Model/
│   │       └── User.php
```

**Correspondance :**
- Namespace: `App\Controller\UsersController`
- Chemin: `src/App/Controller/UsersController.php`

#### Configuration dans composer.json

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

**Pourquoi ?**
- PHP trouve automatiquement les classes
- Plus de `require` partout
- Standardisé

### PSR-7 : HTTP Message Interface

#### Règles pour les Requêtes/Réponses

```php
// ✅ BON (PSR-7)
$request = $request->withMethod('POST');
$request = $request->withUri(new Uri('https://example.com'));
$response = $response->withStatus(200);

// ❌ MAUVAIS (framework spécifique)
$request->method = 'POST'; // Ne marche que dans un framework
```

**Pourquoi ?**
- Compatible entre frameworks
- Réutilisable

### PSR-3 : Logger Interface

#### Standard pour la Logging

```php
// ✅ BON (PSR-3)
$logger->info('User logged in', ['user_id' => 123]);
$logger->error('Database connection failed');
$logger->warning('Low memory', ['usage' => '90%']);

// ❌ MAUVAIS (personnalisé)
$logger->log('User logged in', 'info');
```

---

## 🎯 Pourquoi Suivre ces Standards ?

### 1. **Lisible par Tous**

```
Code sans standard:
→ Chacun écrit à sa façon
→ Difficile de comprendre le code des autres
→ Temps perdu à décoder

Code avec PSR-12:
→ Tout le monde écrit pareil
→ Lecture immédiate
→ Focus sur la logique, pas le style
```

### 2. **Collaboration Facile**

**Scénario typique :**

Sans standard :
```
Alice : "Pourquoi tu utilises des tabs ?"
Bob   : "C'est plus rapide que des espaces"
Alice : "Mais moi j'aime les espaces"
Bob   : "..."
Résultat : Code incohérent, conflits Git constants
```

Avec PSR-12 :
```
Alice : "Le code respecte PSR-12 ✅"
Bob   : "Oui, c'est automatique ✅"
Résultat : Code uniforme, zéro conflit de style
```

### 3. **Évite les Conflits Git**

**Sans standard :**
```diff
- function test(){
- return $a+$b;
+ function test(){
+ return $a + $b;
+ }
```

**Avec PSR-12 (auto-formaté) :**
```diff
- Pas de conflit car formaté automatiquement
```

### 4. **Tools Support**

Tous les outils supportent PSR-12 :
- ✅ **PHPStorm** - Auto-format intégré
- ✅ **VSCode** - Extensions PSR-12
- ✅ **PHP_CodeSniffer** - Vérification auto
- ✅ **PHP-CS-Fixer** - Correction auto

### 5. **Professionnalisme**

**Code respectant PSR-12 = Code Pro**

Les employeurs/reviewers voient :
- ✅ Attention aux détails
- ✅ Code maintenable
- ✅ Expérience avec les standards
- ✅ Facile à intégrer dans une équipe

### 6. **Débuggabilité**

**Code Standard :**
- On sait où chercher les erreurs
- Stack traces cohérentes
- Logs uniformes

**Code Non-Standard :**
- "Où est l'erreur ?" 🤔
- Format bizarre dans les logs
- Difficulté à identifier le problème

---

## 📊 Résumé des Règles Essentielles

| Catégorie | Règle PSR-12 | Exemple |
|-----------|--------------|---------|
| **Longueur** | Max 120 caractères | Voir section 1 |
| **Indentation** | 4 espaces | `    $var = 1;` |
| **Guillemets** | Simples si possible | `'text'` pas `"text"` |
| **Tableaux** | Syntaxe courte | `[]` pas `array()` |
| **Types** | Toujours déclarer | `function test(): int` |
| **Namespace** | En haut du fichier | `namespace App\Controller;` |
| **Classes** | PascalCase | `UserController` |
| **Méthodes** | camelCase | `getUserById()` |
| **Constantes** | MAJUSCULES | `MAX_SIZE` |
| **Opérateurs** | Espacés | `$a = $b + $c` |
| **Multiligne** | Un param par ligne | Voir section 9 |

---

## 🔧 Outils pour Appliquer PSR-12

### Automatique

```bash
# 1. PHP_CodeSniffer - Vérifier
composer cs-check

# 2. PHP-CS-Fixer - Corriger
composer cs-fix

# 3. Tout vérifier
composer check
```

### Manuelle

**Éditeurs de Code :**

**PHPStorm :**
```
File → Settings → Editor → Code Style → PHP
→ Set from → PSR1/PSR2
```

**VSCode :**
```json
// .vscode/settings.json
{
    "php.suggest.basic": false,
    "intelephense.format.braces": "allman"
}
```

---

## 🎓 Conclusion

### Les Standards Principaux

1. **PSR-1** → Noms et structure de base
2. **PSR-4** → Organisation des fichiers
3. **PSR-12** → Style de code (le plus important)
4. **PSR-3** → Logging
5. **PSR-7** → HTTP

### Pourquoi les Suivre ?

✅ Code lisible par tous
✅ Collaboration facilitée
✅ Moins de conflits Git
✅ Professionnalisme
✅ Maintenance facilitée

### Comment les Appliquer ?

```bash
# Automatiquement
composer cs-fix

# Vérifier
composer cs-check
```

**Bonne pratique :** Avant chaque commit !
```bash
composer check  # Tests + Qualité
```

---

**🎉 Avec PSR-12, votre code est propre et professionnel ! 🚀**

