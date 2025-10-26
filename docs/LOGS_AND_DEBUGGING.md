# 📊 Guide des Logs et Debugging - CakePHP 5

## 📋 Table des Matières

1. [DebugKit (Déjà Installé)](#debugkit)
2. [Fichiers de Logs](#fichiers-de-logs)
3. [Comment Logger](#comment-logger)
4. [Packages Recommandés](#packages-recommandés)
5. [Configuration](#configuration)

---

## DebugKit

### ✅ Actuellement Installé

**Package:** `cakephp/debug_kit ^5.0`

### Fonctionnalités

✓ **Logs Viewer** - Voir tous les logs en temps réel  
✓ **SQL Queries** - Requêtes SQL exécutées  
✓ **Performance** - Temps d'exécution  
✓ **Errors** - Erreurs et avertissements  
✓ **Request** - POST/GET data  
✓ **Variables** - Session et variables  
✓ **Headers** - En-têtes HTTP  

### Comment l'Utiliser

#### 1. Accès Automatique

DebugKit s'active **automatiquement** en mode debug.

```bash
# En développement (par défaut)
http://localhost:8765
```

#### 2. Barre DebugKit

La barre DebugKit apparaît en **bas à droite** de la page.

```
┌─────────────────────────────────────┐
│          Page Web Content           │
│                                     │
│  ┌─────────────────────────────┐   │
│  │ 🔧 ⏱️  📊  🐛  📝  ⚙️     │   │ ← DebugKit Toolbar
│  └─────────────────────────────┘   │
└─────────────────────────────────────┘
```

#### 3. Cliquer pour Voir les Détails

Cliquez sur chaque icône pour voir:
- **🔧** - Configuration
- **⏱️** - Temps d'exécution
- **📊** - Statistiques
- **🐛** - Logs
- **📝** - Requêtes SQL
- **⚙️** - Settings

---

## Fichiers de Logs

### Localisation

```
logs/
├── error.log    # Erreurs et exceptions
├── debug.log    # Messages debug
├── queries.log  # Requêtes SQL
└── ...
```

### Consulter les Logs

#### Voir les Dernières Lignes

```bash
tail -50 logs/error.log
tail -50 logs/debug.log
```

#### Suivi en Temps Réel

```bash
tail -f logs/error.log      # Suivi continu
tail -f logs/debug.log
```

#### Rechercher dans les Logs

```bash
grep "ERROR" logs/error.log
grep "User" logs/debug.log
grep "SELECT" logs/queries.log
```

#### Nombre de Lignes

```bash
wc -l logs/error.log
```

#### Format des Dates

```bash
grep "2024-10-24" logs/error.log
```

---

## Comment Logger

### Utiliser la Classe Log

```php
<?php
use Cake\Log\Log;

// Debug
Log::debug('Message de debug');

// Info
Log::info('Informations');

// Warning
Log::warning('Avertissement');

// Error
Log::error('Erreur');

// Critical
Log::critical('Critique');
```

### Dans un Contrôleur

```php
<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Log\Log;

class UsersController extends Controller
{
    public function index()
    {
        Log::debug('Page index utilisateurs');
        $users = $this->Users->find('all')->toArray();
        Log::info('Utilisateurs trouvés: ' . count($users));
        
        $this->set(compact('users'));
    }
}
```

### Avec Injection de Dépendances

```php
<?php
namespace Application\UseCases\User;

use Psr\Log\LoggerInterface;

class CreateUserUseCase
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }
    
    public function execute(string $email, string $name)
    {
        $this->logger->debug('Création utilisateur: ' . $email);
        
        try {
            // ... code ...
            $this->logger->info('Utilisateur créé: ' . $email);
        } catch (\Exception $e) {
            $this->logger->error('Erreur création utilisateur: ' . $e->getMessage());
            throw $e;
        }
    }
}
```

### Voir les Logs en Action

Dans DebugKit:
1. Visitez `http://localhost:8765/users`
2. Regardez la barre DebugKit
3. Cliquez sur **🐛** pour voir les logs
4. Vous verrez vos messages Log::debug(), Log::info(), etc.

---

## Packages Recommandés

### 1. Monolog (Logs Structurés)

**Idéal pour:** Production avec multiples canaux

```bash
composer require monolog/monolog
```

**Avantages:**
- Format structuré et cohérent
- Multiples canaux (file, mail, slack, etc.)
- Filtrage flexible
- Standard de l'industrie

**Configuration:**

```php
// config/app_local.php
'Log' => [
    'debug' => [
        'className' => 'Monolog\Handler\StreamHandler',
        'path' => LOGS . 'debug.log',
        'level' => 'debug',
    ],
    'error' => [
        'className' => 'Monolog\Handler\StreamHandler',
        'path' => LOGS . 'error.log',
        'level' => 'error',
    ],
]
```

### 2. Sentry (Production Error Tracking)

**Idéal pour:** Production avec monitoring

```bash
composer require sentry/sentry
```

**Avantages:**
- Suivi d'erreurs en temps réel
- Alertes email/slack
- Stack traces complètes
- Performance monitoring
- Dashboard web

**Configuration:**

```php
// config/app_local.php
'Error' => [
    'sentryDsn' => env('SENTRY_DSN'),
]
```

### 3. Buggregator (Local Alternative)

**Idéal pour:** Développement local avec interface web

```bash
composer require buggregator/buggregator

# Ou en Docker:
docker run -p 8000:8000 -p 9912:9912 \
    -p 1025:1025 -p 8025:8025 \
    buggregator/server:latest
```

**Avantages:**
- Interface web locale
- Gratuit et open-source
- Captage d'erreurs
- Inspection détaillée
- Pas de serveur externe

**Utilisation:**

```php
// Erreurs capturées automatiquement
// Visitez http://localhost:8000
```

---

## Configuration

### Fichier app_local.php

```php
<?php
return [
    // ... autres configs ...
    
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'debug',
            'url' => env('LOG_DEBUG_URL', null),
            'scopes' => null,
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'error',
            'url' => env('LOG_ERROR_URL', null),
            'scopes' => null,
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
        'queries' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'queries',
            'url' => env('LOG_QUERIES_URL', null),
            'scopes' => ['queriesLog'],
        ],
    ],
];
```

### Niveaux de Log

| Niveau | Usage | Example |
|--------|-------|---------|
| `debug` | Messages de debug détaillés | `Log::debug('Variable: ' . $var)` |
| `info` | Informations générales | `Log::info('User created')` |
| `notice` | Notifications | `Log::notice('File updated')` |
| `warning` | Avertissements | `Log::warning('Deprecated method')` |
| `error` | Erreurs | `Log::error('Connection failed')` |
| `critical` | Problèmes critiques | `Log::critical('System down')` |
| `alert` | Alertes | `Log::alert('Unusual activity')` |
| `emergency` | Urgence | `Log::emergency('Disaster!')` |

---

## Workflow Recommandé

### Développement Local

```
1. Lancez l'application
   http://localhost:8765

2. Regardez DebugKit en bas à droite

3. Cliquez sur 🐛 pour voir les logs

4. Utilisez Log::debug() dans votre code

5. Vérifiez les logs en temps réel
```

### Production

```
1. Utilisez Monolog pour logs structurés

2. Intégrez Sentry pour erreur tracking

3. Configurez alertes email/slack

4. Analysez les logs régulièrement

5. Maintenez une rotation des logs
```

### Debugging

```
1. Activez DebugKit
   -> Voir DebugKit Panel

2. Consultez les fichiers logs
   -> tail -f logs/error.log

3. Utilisez Log::* dans votre code
   -> Vérifiez en temps réel

4. Consultez les requêtes SQL
   -> DebugKit Panel → Queries

5. Vérifiez la performance
   -> DebugKit Panel → Timers
```

---

## Commandes Utiles

```bash
# Voir le dernier log d'erreur
tail -1 logs/error.log

# Voir les 50 derniers logs
tail -50 logs/debug.log

# Suivi en temps réel
tail -f logs/error.log

# Chercher une erreur spécifique
grep "OutOfMemory" logs/error.log

# Compter les erreurs
grep -c "ERROR" logs/error.log

# Filtrer par date
grep "2024-10-24" logs/error.log | head -20

# Voir les lignes après une date
sed -n '/2024-10-24 14:00/,$p' logs/error.log | head -50

# Exporter les logs
cat logs/error.log > backup_errors.log

# Nettoyer les vieux logs
find logs/ -name "*.log" -mtime +30 -delete
```

---

## Résolution de Problèmes

### Les Logs n'Apparaissent Pas dans DebugKit

**Vérifiez:**
- Mode debug activé (`debug: true` in config/app.php)
- DebugKit plugin chargé
- Page rafraîchie

### Logs Pas Créés dans le Fichier

**Vérifiez:**
- Dossier `logs/` existe
- Permissions lecture/écriture OK
- Log level approprié configuré

### Trop de Logs

**Solution:**
```php
// Augmentez le niveau minimum
'levels' => ['error', 'critical'],  // Moins de logs
```

### Logs Manquent dans Production

**Solution:**
```php
// config/app_local.php
'Log' => [
    'error' => [
        'className' => 'Cake\Log\Engine\FileLog',
        'path' => LOGS,
        'file' => 'error',
        'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
    ],
]
```

---

## Résumé

✅ **Actuellement disponible:**
- DebugKit (gratuit, déjà installé)
- Fichiers logs natifs CakePHP

✅ **Recommandé d'ajouter:**
- Monolog pour structure
- Sentry pour production

✅ **Optionnel:**
- Buggregator pour interface web locale

**Commencez simplement avec DebugKit!** 🚀

