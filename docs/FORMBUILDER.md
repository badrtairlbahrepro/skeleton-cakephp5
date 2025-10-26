# FormBuilder AdminLTE - Documentation

## 📋 Table des Matières

1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Méthodes Disponibles](#méthodes-disponibles)
5. [Exemples d'Utilisation](#exemples-dutilisation)
6. [Options et Paramètres](#options-et-paramètres)
7. [Styles et Classes CSS](#styles-et-classes-css)
8. [Exemples Complets](#exemples-complets)
9. [Dépannage](#dépannage)

## Introduction

Le **FormBuilder AdminLTE** est un helper CakePHP personnalisé qui permet de créer facilement des formulaires élégants et fonctionnels avec le style AdminLTE. Il génère automatiquement des éléments de formulaire avec des icônes, des groupes d'entrée et une structure HTML cohérente.

### ✨ Fonctionnalités

- 🎨 **Style AdminLTE** : Intégration parfaite avec le thème AdminLTE
- 🔧 **Helper CakePHP** : Utilise les helpers natifs de CakePHP
- 📱 **Responsive** : Compatible avec Bootstrap 5
- 🎯 **Icônes FontAwesome** : Support des icônes FontAwesome
- 🔄 **Input Groups** : Groupes d'entrée avec icônes et boutons
- 📁 **Upload de fichiers** : Gestion des fichiers avec prévisualisation
- 🔀 **Sélecteurs multiples** : Support Ctrl/Cmd+clic pour sélection multiple
- 🎛️ **Switches (Toggle)** : Boutons toggle animés pour les préférences
- ✅ **Validation** : Support des états de validation Bootstrap

## Installation

### 1. Charger le Helper

Dans votre `AppController` ou contrôleur spécifique :

```php
// src/Controller/AppController.php
public function beforeRender(\Cake\Event\EventInterface $event): void
{
    parent::beforeRender($event);
    // Charger le helper AdminLteForm pour tous les contrôleurs
    $this->viewBuilder()->addHelper('AdminLteForm');
}
```

### 2. Inclure les Assets

Dans votre layout principal :

```html
<!-- CSS AdminLTE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- jQuery (requis par AdminLTE) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdn.jsdelivp.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
```

## Configuration

### Variables d'Environnement

Aucune configuration spéciale n'est requise. Le helper utilise les configurations par défaut de CakePHP.

### Personnalisation des Icônes

Vous pouvez personnaliser les icônes par défaut en modifiant le helper :

```php
// Dans AdminLteFormHelper.php
protected array $defaultIcons = [
    'text' => 'fas fa-user',
    'email' => 'fas fa-envelope',
    'password' => 'fas fa-lock',
    'phone' => 'fas fa-phone',
    'file' => 'fas fa-camera',
    'select' => 'fas fa-list',
    'textarea' => 'fas fa-comment'
];
```

## Méthodes Disponibles

### 1. `textInput()` - Champ Texte

Génère un champ de saisie texte avec icône.

```php
<?= $this->AdminLteForm->textInput('name', [
    'label' => ['text' => 'Nom complet'],
    'placeholder' => 'Votre nom',
    'templateVars' => ['icon' => 'fas fa-user']
]) ?>
```

**HTML généré :**
```html
<div class="form-group">
    <label for="name">Nom complet</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
        </div>
        <input type="text" name="name" class="form-control" placeholder="Votre nom">
    </div>
</div>
```

### 2. `emailInput()` - Champ Email

Génère un champ email avec icône d'enveloppe.

```php
<?= $this->AdminLteForm->emailInput('email', [
    'label' => ['text' => 'Adresse email'],
    'placeholder' => 'votre@email.com'
]) ?>
```

### 3. `passwordInput()` - Champ Mot de Passe

Génère un champ mot de passe avec bouton afficher/masquer.

```php
<?= $this->AdminLteForm->passwordInput('password', [
    'label' => ['text' => 'Mot de passe'],
    'placeholder' => 'Entrez votre mot de passe'
]) ?>
```

**Fonctionnalités :**
- Bouton œil pour afficher/masquer le mot de passe
- JavaScript automatique pour la fonctionnalité
- Icône de cadenas par défaut

### 4. `textareaInput()` - Zone de Texte

Génère une zone de texte multi-lignes avec icône.

```php
<?= $this->AdminLteForm->textareaInput('message', [
    'label' => ['text' => 'Message'],
    'rows' => 4,
    'placeholder' => 'Votre message...'
]) ?>
```

### 5. `fileInput()` - Champ Fichier

Génère un champ de téléchargement de fichier style AdminLTE.

```php
<?= $this->AdminLteForm->fileInput('avatar', [
    'label' => ['text' => 'Photo de profil'],
    'templateVars' => ['buttonText' => 'Upload']
]) ?>
```

**Fonctionnalités :**
- Affichage du nom du fichier sélectionné
- Bouton "Upload" personnalisable
- JavaScript automatique pour la prévisualisation

### 6. `selectInput()` - Sélecteur

Génère une liste déroulante avec icône.

```php
<?= $this->AdminLteForm->selectInput('country', [
    'label' => ['text' => 'Pays'],
    'options' => [
        'FR' => 'France',
        'BE' => 'Belgique',
        'CH' => 'Suisse'
    ],
    'templateVars' => ['icon' => 'fas fa-globe']
]) ?>
```

### 7. `checkboxInput()` - Case à Cocher

Génère une case à cocher avec label.

```php
<?= $this->AdminLteForm->checkboxInput('newsletter', [
    'label' => ['text' => 'Je souhaite recevoir la newsletter'],
    'value' => '1'
]) ?>
```

### 8. `radioInput()` - Bouton Radio

Génère un bouton radio avec label.

```php
<?= $this->AdminLteForm->radioInput('theme', [
    'label' => ['text' => 'Thème clair'],
    'value' => 'light',
    'name' => 'theme'
]) ?>
```

### 9. `submitButton()` - Bouton d'Envoi

Génère un bouton de soumission.

```php
<?= $this->AdminLteForm->submitButton('Sauvegarder', [
    'class' => 'btn btn-success'
]) ?>
```

### 10. `selectMultipleInput()` - Sélecteur Multiple

Génère un sélecteur permettant la sélection multiple avec Ctrl/Cmd+clic.

```php
<?= $this->AdminLteForm->selectMultipleInput('skills', [
    'label' => ['text' => 'Compétences'],
    'options' => [
        'php' => 'PHP',
        'javascript' => 'JavaScript',
        'python' => 'Python',
        'java' => 'Java'
    ],
    'templateVars' => ['icon' => 'fas fa-code']
]) ?>
```

**Fonctionnalités :**
- Sélection multiple avec Ctrl/Cmd+clic
- Classes AdminLTE : `custom-select`
- Support des icônes personnalisées
- Options générées dynamiquement

### 11. `switchInput()` - Switch (Toggle)

Génère un switch animé pour les préférences et options.

```php
<?= $this->AdminLteForm->switchInput('notifications', [
    'label' => ['text' => 'Recevoir les notifications'],
    'value' => '1',
    'checked' => true
]) ?>
```

**Fonctionnalités :**
- Toggle animé avec CSS AdminLTE
- État activé/désactivé configurable
- Classes : `custom-control custom-switch`
- Accessibilité avec labels liés

### 12. `resetButton()` - Bouton de Réinitialisation

Génère un bouton de réinitialisation.

```php
<?= $this->AdminLteForm->resetButton('Annuler', [
    'class' => 'btn btn-secondary'
]) ?>
```

## Exemples d'Utilisation

### Formulaire de Contact Simple

```php
<?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <?= $this->AdminLteForm->textInput('name', [
                'label' => ['text' => 'Nom complet'],
                'placeholder' => 'Votre nom complet',
                'templateVars' => ['icon' => 'fas fa-user']
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->AdminLteForm->emailInput('email', [
                'label' => ['text' => 'Adresse email'],
                'placeholder' => 'votre@email.com'
            ]) ?>
        </div>
    </div>

    <?= $this->AdminLteForm->textareaInput('message', [
        'label' => ['text' => 'Message'],
        'placeholder' => 'Décrivez votre demande...',
        'rows' => 5
    ]) ?>

    <!-- Sélecteur multiple -->
    <?= $this->AdminLteForm->selectMultipleInput('interests', [
        'label' => ['text' => 'Centres d\'intérêt'],
        'options' => [
            'web' => 'Développement Web',
            'mobile' => 'Développement Mobile',
            'ai' => 'Intelligence Artificielle'
        ]
    ]) ?>

    <!-- Switch pour notifications -->
    <?= $this->AdminLteForm->switchInput('newsletter', [
        'label' => ['text' => 'Recevoir la newsletter'],
        'checked' => false
    ]) ?>

    <!-- Case à cocher classique -->
    <?= $this->AdminLteForm->checkboxInput('terms', [
        'label' => ['text' => 'J\'accepte les conditions d\'utilisation']
    ]) ?>
</div>
<div class="card-footer text-right">
    <?= $this->AdminLteForm->resetButton('Annuler', ['class' => 'btn btn-secondary mr-2']) ?>
    <?= $this->AdminLteForm->submitButton('Envoyer le message') ?>
</div>
<?= $this->Form->end() ?>
```

### Formulaire d'Inscription

```php
<?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <?= $this->AdminLteForm->textInput('username', [
                'label' => ['text' => 'Nom d\'utilisateur'],
                'placeholder' => 'Choisissez un nom d\'utilisateur'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->AdminLteForm->emailInput('email', [
                'label' => ['text' => 'Adresse email'],
                'placeholder' => 'votre@email.com'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $this->AdminLteForm->passwordInput('password', [
                'label' => ['text' => 'Mot de passe'],
                'placeholder' => 'Entrez votre mot de passe'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->AdminLteForm->passwordInput('confirm_password', [
                'label' => ['text' => 'Confirmer le mot de passe'],
                'placeholder' => 'Confirmez votre mot de passe'
            ]) ?>
        </div>
    </div>

    <!-- Sélecteur multiple pour compétences -->
    <?= $this->AdminLteForm->selectMultipleInput('skills', [
        'label' => ['text' => 'Compétences techniques'],
        'options' => [
            'php' => 'PHP',
            'javascript' => 'JavaScript',
            'python' => 'Python',
            'java' => 'Java'
        ]
    ]) ?>

    <!-- Switch pour notifications -->
    <?= $this->AdminLteForm->switchInput('notifications', [
        'label' => ['text' => 'Recevoir les notifications par email'],
        'checked' => true
    ]) ?>

    <!-- Case à cocher pour les conditions -->
    <?= $this->AdminLteForm->checkboxInput('terms', [
        'label' => ['text' => 'J\'accepte les termes et conditions']
    ]) ?>
</div>
<div class="card-footer text-right">
    <?= $this->AdminLteForm->submitButton('S\'inscrire', ['class' => 'btn btn-success']) ?>
</div>
<?= $this->Form->end() ?>
```

### Formulaire de Profil avec Upload

```php
<?= $this->Form->create(null, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) ?>
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <?= $this->AdminLteForm->textInput('firstname', [
                'label' => ['text' => 'Prénom'],
                'placeholder' => 'Votre prénom'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->AdminLteForm->textInput('lastname', [
                'label' => ['text' => 'Nom'],
                'placeholder' => 'Votre nom de famille'
            ]) ?>
        </div>
    </div>

    <?= $this->AdminLteForm->emailInput('email', [
        'label' => ['text' => 'Adresse email'],
        'placeholder' => 'votre@email.com'
    ]) ?>

    <?= $this->AdminLteForm->textareaInput('bio', [
        'label' => ['text' => 'Biographie'],
        'placeholder' => 'Parlez-nous de vous...',
        'rows' => 4
    ]) ?>

    <?= $this->AdminLteForm->fileInput('avatar', [
        'label' => ['text' => 'Photo de profil']
    ]) ?>

    <!-- Sélecteur multiple pour langues -->
    <?= $this->AdminLteForm->selectMultipleInput('languages', [
        'label' => ['text' => 'Langues parlées'],
        'options' => [
            'fr' => 'Français',
            'en' => 'Anglais',
            'es' => 'Espagnol',
            'de' => 'Allemand'
        ]
    ]) ?>

    <!-- Switches pour préférences -->
    <div class="form-group">
        <label class="form-label">Préférences</label>
        <?= $this->AdminLteForm->switchInput('dark_mode', [
            'label' => ['text' => 'Mode sombre'],
            'checked' => false
        ]) ?>
        <?= $this->AdminLteForm->switchInput('public_profile', [
            'label' => ['text' => 'Profil public'],
            'checked' => true
        ]) ?>
    </div>

    <div class="form-group">
        <label class="form-label">Thème</label>
        <div class="row">
            <div class="col-md-4">
                <?= $this->AdminLteForm->radioInput('theme', [
                    'label' => ['text' => 'Clair'],
                    'value' => 'light',
                    'name' => 'theme'
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $this->AdminLteForm->radioInput('theme', [
                    'label' => ['text' => 'Sombre'],
                    'value' => 'dark',
                    'name' => 'theme'
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $this->AdminLteForm->radioInput('theme', [
                    'label' => ['text' => 'Auto'],
                    'value' => 'auto',
                    'name' => 'theme'
                ]) ?>
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-right">
    <?= $this->AdminLteForm->submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
</div>
<?= $this->Form->end() ?>
```

## Options et Paramètres

### Options Communes

| Option | Type | Description | Exemple |
|--------|------|-------------|---------|
| `label` | array | Configuration du label | `['text' => 'Nom', 'class' => 'form-label']` |
| `placeholder` | string | Texte d'aide dans le champ | `'Votre nom'` |
| `class` | string | Classes CSS additionnelles | `'form-control custom-class'` |
| `div` | boolean/array | Configuration du div wrapper | `false` ou `['class' => 'custom-div']` |
| `templateVars` | array | Variables pour le template | `['icon' => 'fas fa-user']` |

### Options Spécifiques

#### `fileInput()`
- `templateVars['buttonText']` : Texte du bouton Upload (défaut: 'Upload')

#### `passwordInput()`
- Aucune option spécifique, utilise les options communes

#### `selectInput()`
- `options` : Array des options du select
- `empty` : Texte de l'option vide (défaut: 'Sélectionner une option')

#### `selectMultipleInput()`
- `options` : Array des options du select
- `empty` : Texte de l'option vide (défaut: 'Sélectionner des options')
- Support Ctrl/Cmd+clic pour sélection multiple

#### `switchInput()`
- `value` : Valeur du champ (défaut: '1')
- `checked` : Si le switch est activé (boolean)
- Classes : `custom-control custom-switch`

#### `checkboxInput()` / `radioInput()`
- `value` : Valeur du champ
- `checked` : Si le champ est coché (boolean)
- `name` : Nom du champ (pour les radio, doit être identique dans le groupe)

## Styles et Classes CSS

### Classes Principales

```css
/* Form Group */
.form-group {
    margin-bottom: 1rem;
}

/* Input Group */
.input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
}

.input-group-prepend {
    display: flex;
}

.input-group-text {
    display: flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
}

/* Custom File Input */
.custom-file {
    position: relative;
    display: flex;
    width: 100%;
    height: 40px;
}

.custom-file-input {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 40px;
    margin: 0;
    opacity: 0;
    cursor: pointer;
}

.custom-file-label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1;
    height: 40px;
    padding: 8px 12px;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
}
```

### Personnalisation

Vous pouvez personnaliser l'apparence en ajoutant vos propres classes CSS :

```php
<?= $this->AdminLteForm->textInput('name', [
    'class' => 'form-control custom-input',
    'templateVars' => ['icon' => 'fas fa-user custom-icon']
]) ?>
```

## Exemples Complets

### 1. Formulaire de Contact

Voir : `templates/FormBuilder/contact.php`

### 2. Formulaire d'Inscription

Voir : `templates/FormBuilder/register.php`

### 3. Formulaire de Profil

Voir : `templates/FormBuilder/profile.php`

### 4. Formulaire de Recherche

Voir : `templates/FormBuilder/search.php`

### 5. Formulaire avec Sélecteurs Multiples

Voir : `templates/FormBuilder/multiple.php`

### 6. Formulaire avec Switches

Voir : `templates/FormBuilder/switches.php`

## Dépannage

### Problèmes Courants

#### 1. Labels dupliqués
**Problème :** Les labels apparaissent deux fois
**Solution :** Utilisez `'label' => false` dans les options

```php
// ❌ Incorrect
<?= $this->AdminLteForm->textInput('name', ['label' => 'Nom']) ?>

// ✅ Correct
<?= $this->AdminLteForm->textInput('name', [
    'label' => ['text' => 'Nom'],
    'div' => false
]) ?>
```

#### 2. Boutons radio ne s'affichent pas
**Problème :** Les boutons radio ne sont pas visibles
**Solution :** Utilisez la méthode `radioInput()` correctement

```php
// ✅ Correct - Groupe de boutons radio
<div class="form-group">
    <label class="form-label">Thème</label>
    <div class="row">
        <div class="col-md-4">
            <?= $this->AdminLteForm->radioInput('theme', [
                'label' => ['text' => 'Clair'],
                'value' => 'light',
                'name' => 'theme'
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $this->AdminLteForm->radioInput('theme', [
                'label' => ['text' => 'Sombre'],
                'value' => 'dark',
                'name' => 'theme'
            ]) ?>
        </div>
    </div>
</div>
```

#### 3. Champ fichier ne fonctionne pas
**Problème :** Le champ fichier ne sélectionne pas de fichier
**Solution :** Vérifiez que le formulaire a `enctype="multipart/form-data"`

```php
// ✅ Correct
<?= $this->Form->create(null, ['enctype' => 'multipart/form-data']) ?>
```

#### 4. Sélecteur multiple ne fonctionne pas
**Problème :** Le sélecteur multiple ne permet pas la sélection multiple
**Solution :** Utilisez `selectMultipleInput()` et vérifiez les classes CSS

```php
// ✅ Correct - Sélecteur multiple
<?= $this->AdminLteForm->selectMultipleInput('skills', [
    'label' => ['text' => 'Compétences'],
    'options' => [
        'php' => 'PHP',
        'javascript' => 'JavaScript'
    ]
]) ?>
```

#### 5. Switch ne s'affiche pas correctement
**Problème :** Le switch ne ressemble pas à un toggle
**Solution :** Vérifiez que les classes `custom-control custom-switch` sont appliquées

```php
// ✅ Correct - Switch avec classes AdminLTE
<?= $this->AdminLteForm->switchInput('notifications', [
    'label' => ['text' => 'Notifications'],
    'checked' => true
]) ?>
```

#### 6. Icônes ne s'affichent pas
**Problème :** Les icônes FontAwesome ne sont pas visibles
**Solution :** Vérifiez que FontAwesome est chargé

```html
<!-- Dans votre layout -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
```

### Debug

Pour déboguer les problèmes, vous pouvez :

1. **Vérifier le HTML généré** : Inspecter l'élément dans le navigateur
2. **Vérifier les erreurs JavaScript** : Ouvrir la console du navigateur
3. **Vérifier les classes CSS** : S'assurer que Bootstrap et AdminLTE sont chargés

### Support

Pour obtenir de l'aide :

1. Consultez cette documentation
2. Vérifiez les exemples dans `templates/FormBuilder/`
3. Inspectez le code source du helper dans `src/View/Helper/AdminLteFormHelper.php`

---

## 🎉 Conclusion

Le FormBuilder AdminLTE simplifie considérablement la création de formulaires élégants et fonctionnels dans CakePHP. Avec ses méthodes intuitives et son intégration parfaite avec AdminLTE, vous pouvez créer des interfaces utilisateur professionnelles en quelques lignes de code.

**Bon développement ! 🚀**
