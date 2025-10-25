# 🚨 Guide Complet: Gestion des Erreurs en CakePHP 5

## Table des Matières
1. [Architecture Générale](#architecture-générale)
2. [Flux d'Erreur](#flux-derreur)
3. [Configuration](#configuration)
4. [Templates d'Erreur](#templates-derreur)
5. [Lancer des Exceptions](#lancer-des-exceptions)
6. [Types d'Erreurs](#types-derreurs)
7. [Mode Debug vs Production](#mode-debug-vs-production)
8. [Visualisation des Logs](#visualisation-des-logs)

---

## Architecture Générale

### Trois Composants Clés

#### 1. **ErrorHandlerMiddleware** (`src/Application.php` ligne 69)
Le middleware qui capture TOUTES les exceptions et erreurs de l'application.

```php
$middlewareQueue->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))
```

**Fonction:** 
- Intercepte toutes les exceptions levées
- Détermine le code HTTP approprié
- Sélectionne le template d'erreur
- Enregistre l'erreur dans les logs

#### 2. **Configuration d'Erreur** (`config/app.php` lignes 75-83)
Contrôle le comportement global des erreurs.

```php
'Error' => [
    'errorLevel' => E_ALL & ~E_USER_DEPRECATED,  // Tous les erreurs sauf deprecated
    'log' => true,                                 // Enregistrer les erreurs
    'trace' => true,                               // Afficher la stack trace
    'skipLog' => [],                               // Erreurs à ne pas logger
    'ignoredDeprecationPaths' => [
        'vendor/cakephp/cakephp/src/I18n/I18n.php',
    ],
],
```

#### 3. **Templates d'Erreur** (`templates/Error/`)
Templates qui affichent l'erreur à l'utilisateur.

```
templates/Error/
├── error404.php      (404 - Not Found)
├── error403.php      (403 - Forbidden)
├── error500.php      (500 - Internal Server Error)
└── error.php         (Erreur générique)
```

---

## Flux d'Erreur

### Étape par Étape

```
┌─────────────────────────────────────────────────────────────┐
│ 1. CODE GÉNÈRE UNE EXCEPTION                                │
│    └─ throw new NotFoundException('User not found')         │
└────────────────────┬────────────────────────────────────────┘
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 2. ErrorHandlerMiddleware CAPTURE L'EXCEPTION              │
│    ├─ Extrait le code HTTP (404)                           │
│    ├─ Extrait le message d'erreur                          │
│    └─ Crée la réponse                                      │
└────────────────────┬────────────────────────────────────────┘
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 3. SÉLECTION DU TEMPLATE                                    │
│    ├─ 404 → templates/Error/error404.php                   │
│    ├─ 403 → templates/Error/error403.php                   │
│    ├─ 500 → templates/Error/error500.php                   │
│    └─ Autres → templates/Error/error.php                   │
└────────────────────┬────────────────────────────────────────┘
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 4. RENDU DU TEMPLATE                                        │
│    ├─ Layout: templates/layout/error.php                   │
│    ├─ Variables: $error (l'exception)                      │
│    └─ Réponse envoyée au client                            │
└────────────────────┬────────────────────────────────────────┘
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 5. ENREGISTREMENT DANS LES LOGS                            │
│    └─ logs/error.log (avec stack trace)                    │
└─────────────────────────────────────────────────────────────┘
```

---

## Configuration

### Paramètres Disponibles

| Paramètre | Type | Défaut | Fonction |
|-----------|------|--------|----------|
| `errorLevel` | int | E_ALL | Les types d'erreurs à capturer |
| `log` | bool | true | Enregistrer les erreurs dans les logs |
| `trace` | bool | true | Afficher la stack trace (debug mode) |
| `skipLog` | array | [] | Classes d'exception à ignorer |
| `ignoredDeprecationPaths` | array | [] | Fichiers dont les deprecations sont ignorées |

### Exemple: Configuration Personnalisée

Pour ignorer certaines exceptions dans les logs:

```php
'Error' => [
    'skipLog' => [
        'Cake\Http\Exception\NotFoundException',
        'Cake\Http\Exception\ForbiddenException',
    ],
    'trace' => env('APP_DEBUG', false), // Trace seulement en debug
],
```

---

## Templates d'Erreur

### Structure d'un Template d'Erreur

Chaque template reçoit automatiquement la variable `$error` (l'exception):

```php
<?php
// templates/Error/error500.php
$this->layout = 'error'; // Utilise le layout d'erreur
?>
<div class="error-page">
    <h1>500 - Internal Server Error</h1>
    <?php if (!empty($error)): ?>
        <p><?= h($error->getMessage()) ?></p>
    <?php endif; ?>
</div>
```

### Layout d'Erreur

```php
<?php
// templates/layout/error.php - Utilisé pour TOUS les templates d'erreur
?>
<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body>
    <div class="login-box">
        <div class="card card-outline card-danger">
            <div class="card-body">
                <?= $this->fetch('content') ?> <!-- Contenu du template d'erreur -->
            </div>
        </div>
    </div>
</body>
</html>
```

### Créer une Template Custom pour une Erreur Spécifique

```php
// templates/Error/error403.php
$this->layout = 'error';
?>
<div class="error-page">
    <h1 class="headline text-warning">403</h1>
    <div class="error-message">
        <h4>Access Forbidden</h4>
        <p>You don't have permission to access this resource.</p>
    </div>
</div>
```

---

## Lancer des Exceptions

### Exceptions HTTP Disponibles

```php
use Cake\Http\Exception\{
    BadRequestException,
    ConflictException,
    ForbiddenException,
    GoneException,
    InternalErrorException,
    MethodNotAllowedException,
    NotAcceptableException,
    NotFoundException,
    NotImplementedException,
    ServiceUnavailableException,
    UnauthorizedException,
};
```

### Exemples d'Utilisation

#### 1. **NotFoundException** (404)
Levée quand une ressource n'existe pas:

```php
use Cake\Http\Exception\NotFoundException;

public function view(int $id)
{
    $user = $this->Users->findById($id);
    
    if (!$user) {
        throw new NotFoundException('User not found');
    }
    
    $this->set(compact('user'));
}
```

#### 2. **ForbiddenException** (403)
Levée quand l'accès est refusé:

```php
use Cake\Http\Exception\ForbiddenException;

public function admin()
{
    if (!$this->Auth->user('is_admin')) {
        throw new ForbiddenException('Admin access required');
    }
}
```

#### 3. **BadRequestException** (400)
Levée quand la requête est invalide:

```php
use Cake\Http\Exception\BadRequestException;

public function save()
{
    if (!$this->request->is('post')) {
        throw new BadRequestException('POST request required');
    }
}
```

#### 4. **UnauthorizedException** (401)
Levée quand l'utilisateur n'est pas authentifié:

```php
use Cake\Http\Exception\UnauthorizedException;

public function profile()
{
    if (!$this->Auth->user()) {
        throw new UnauthorizedException('Login required');
    }
}
```

---

## Types d'Erreurs

### HTTP Status Codes

| Code | Classe | Cas d'Usage |
|------|--------|-----------|
| **400** | BadRequestException | Requête invalide |
| **401** | UnauthorizedException | Non authentifié |
| **403** | ForbiddenException | Accès refusé |
| **404** | NotFoundException | Ressource non trouvée |
| **405** | MethodNotAllowedException | Méthode HTTP non autorisée |
| **409** | ConflictException | Conflit (ex: doublon) |
| **410** | GoneException | Ressource supprimée |
| **500** | InternalErrorException | Erreur serveur |
| **501** | NotImplementedException | Fonctionnalité non implémentée |
| **503** | ServiceUnavailableException | Service indisponible |

### Exemple: Gérer Plusieurs Cas

```php
public function delete(int $id)
{
    $post = $this->Posts->findById($id);
    
    if (!$post) {
        throw new NotFoundException('Post not found');
    }
    
    if ($post->user_id !== $this->Auth->user('id')) {
        throw new ForbiddenException('You cannot delete this post');
    }
    
    if ($this->Posts->delete($post)) {
        $this->Flash->success('Post deleted');
        return $this->redirect(['action' => 'index']);
    }
}
```

---

## Mode Debug vs Production

### Mode DEBUG (debug = true)

**Fichier:** `config/app.php` → `'debug' => true`

**Comportement:**
- ✅ Affiche la **stack trace complète**
- ✅ Montre tous les **détails de l'erreur**
- ✅ Affiche les **variables locales**
- ✅ Utile pour le **développement**
- ❌ **NE PAS UTILISER EN PRODUCTION** (danger de sécurité!)

**Exemple d'affichage:**
```
Internal Server Error
Error: SQLSTATE[HY000]: General error: 1 no such table: users
File: /app/src/Model/Table/UsersTable.php
Line: 42

Stack Trace:
[0] /app/src/Controller/UsersController.php:15
    UsersController::index()
...
```

### Mode PRODUCTION (debug = false)

**Fichier:** `config/app.php` → `'debug' => false`

**Comportement:**
- ✅ Affiche un **message générique**
- ✅ **Cache la stack trace**
- ✅ **Enregistre les erreurs** dans les logs pour audit
- ✅ **Plus sécurisé**

**Exemple d'affichage:**
```
Internal Server Error

An internal server error has occurred.
```

### Switch Entre les Modes

```php
// config/app.php
'debug' => env('APP_DEBUG', false),
```

Définir via `.env`:
```
APP_DEBUG=true  # En développement
APP_DEBUG=false # En production
```

---

## Visualisation des Logs

### Accéder au Log Viewer Web

```
http://localhost:8765/logs
```

### Voir les Erreurs Spécifiques

```
http://localhost:8765/logs/view/error
```

### Structure d'un Fichier Log

Chaque entrée contient:
- **Timestamp** - Date et heure
- **Level** - ERROR, WARNING, DEBUG, etc.
- **Message** - Message d'erreur
- **Stack Trace** - Chemin d'erreur complet

**Exemple:**
```
2025-10-24 23:17:52 Error: SQLSTATE[HY000]: General error: 1 no such table: users
CORE/src/Database/Query.php:256
Stack Trace:
#0 /app/src/Model/Table/UsersTable.php(42): ...
#1 /app/src/Controller/UsersController.php(15): ...
```

### Télécharger les Logs

Bouton "Download" sur la page du log viewer pour exporter et analyser localement.

---

## Cas d'Usage Pratiques

### 1. Valider et Lancer une Exception

```php
public function save()
{
    if (!$this->request->is('post')) {
        throw new BadRequestException('POST required');
    }
    
    $data = $this->request->getData();
    
    if (empty($data['email'])) {
        throw new BadRequestException('Email is required');
    }
    
    // Sauvegarder...
}
```

### 2. Capturer une Exception Spécifique

```php
try {
    $user = $this->getUserUseCase->execute($id);
} catch (\RuntimeException $e) {
    $this->Flash->error($e->getMessage());
    return $this->redirect(['action' => 'index']);
}
```

### 3. Logging Personnalisé

```php
use Cake\Log\Log;

Log::error('Critical error: ' . $e->getMessage(), ['user_id' => $this->Auth->user('id')]);
```

---

## Résumé

| Aspect | Localisation | Rôle |
|--------|--------------|------|
| **Capture** | `src/Application.php:69` | ErrorHandlerMiddleware |
| **Config** | `config/app.php:75-83` | Paramètres d'erreur |
| **Templates** | `templates/Error/` | Affichage utilisateur |
| **Logs** | `logs/error.log` | Enregistrement erreurs |
| **Viewer** | `/logs` | Interface web (Telescope) |

---

## Commandes Utiles

```bash
# Voir les erreurs en temps réel
tail -f logs/error.log

# Vider les logs
rm logs/error.log

# Voir les autres types de logs
ls logs/
```

---

**Créé:** 2025-10-24  
**Auteur:** Assistant CakePHP 5  
**Version:** 1.0
