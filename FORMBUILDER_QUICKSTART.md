# FormBuilder AdminLTE - Guide Rapide

## 🚀 Démarrage Rapide

### 1. Charger le Helper

```php
// Dans AppController
public function beforeRender(\Cake\Event\EventInterface $event): void
{
    parent::beforeRender($event);
    $this->viewBuilder()->addHelper('AdminLteForm');
}
```

### 2. Utilisation de Base

```php
<?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
<div class="card-body">
    <!-- Champ texte avec icône -->
    <?= $this->AdminLteForm->textInput('name', [
        'label' => ['text' => 'Nom complet'],
        'placeholder' => 'Votre nom',
        'templateVars' => ['icon' => 'fas fa-user']
    ]) ?>

    <!-- Champ email -->
    <?= $this->AdminLteForm->emailInput('email', [
        'label' => ['text' => 'Email'],
        'placeholder' => 'votre@email.com'
    ]) ?>

    <!-- Mot de passe avec bouton afficher/masquer -->
    <?= $this->AdminLteForm->passwordInput('password', [
        'label' => ['text' => 'Mot de passe'],
        'placeholder' => 'Votre mot de passe'
    ]) ?>

    <!-- Zone de texte -->
    <?= $this->AdminLteForm->textareaInput('message', [
        'label' => ['text' => 'Message'],
        'rows' => 4,
        'placeholder' => 'Votre message...'
    ]) ?>

    <!-- Sélecteur -->
    <?= $this->AdminLteForm->selectInput('country', [
        'label' => ['text' => 'Pays'],
        'options' => ['FR' => 'France', 'BE' => 'Belgique'],
        'templateVars' => ['icon' => 'fas fa-globe']
    ]) ?>

    <!-- Case à cocher -->
    <?= $this->AdminLteForm->checkboxInput('newsletter', [
        'label' => ['text' => 'Newsletter']
    ]) ?>

    <!-- Bouton radio -->
    <?= $this->AdminLteForm->radioInput('theme', [
        'label' => ['text' => 'Clair'],
        'value' => 'light',
        'name' => 'theme'
    ]) ?>

    <!-- Sélecteur multiple -->
    <?= $this->AdminLteForm->selectMultipleInput('skills', [
        'label' => ['text' => 'Compétences'],
        'options' => [
            'php' => 'PHP',
            'javascript' => 'JavaScript',
            'python' => 'Python'
        ]
    ]) ?>

    <!-- Switch (Toggle) -->
    <?= $this->AdminLteForm->switchInput('notifications', [
        'label' => ['text' => 'Recevoir les notifications'],
        'checked' => true
    ]) ?>

    <!-- Upload de fichier -->
    <?= $this->AdminLteForm->fileInput('avatar', [
        'label' => ['text' => 'Photo de profil']
    ]) ?>
</div>
<div class="card-footer text-right">
    <?= $this->AdminLteForm->resetButton('Annuler', ['class' => 'btn btn-secondary mr-2']) ?>
    <?= $this->AdminLteForm->submitButton('Envoyer', ['class' => 'btn btn-primary']) ?>
</div>
<?= $this->Form->end() ?>
```

## 📋 Méthodes Disponibles

| Méthode | Description | Icône par défaut |
|---------|-------------|------------------|
| `textInput()` | Champ texte | `fas fa-user` |
| `emailInput()` | Champ email | `fas fa-envelope` |
| `passwordInput()` | Mot de passe avec toggle | `fas fa-lock` |
| `textareaInput()` | Zone de texte | `fas fa-comment` |
| `fileInput()` | Upload de fichier | `fas fa-camera` |
| `selectInput()` | Liste déroulante | `fas fa-list` |
| `selectMultipleInput()` | Sélecteur multiple | `fas fa-list` |
| `checkboxInput()` | Case à cocher | - |
| `radioInput()` | Bouton radio | - |
| `switchInput()` | Switch (Toggle) | - |
| `submitButton()` | Bouton d'envoi | - |
| `resetButton()` | Bouton reset | - |

## 🎨 Options Principales

```php
[
    'label' => ['text' => 'Label du champ'],
    'placeholder' => 'Texte d\'aide',
    'class' => 'classes-css-additionnelles',
    'templateVars' => ['icon' => 'fas fa-icon'],
    'value' => 'valeur-par-defaut',
    'checked' => true, // pour checkbox/radio
    'name' => 'nom-du-champ' // pour radio
]
```

## 🔧 Exemples Pratiques

### Formulaire de Contact

```php
<?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <?= $this->AdminLteForm->textInput('name', [
                'label' => ['text' => 'Nom'],
                'templateVars' => ['icon' => 'fas fa-user']
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->AdminLteForm->emailInput('email', [
                'label' => ['text' => 'Email']
            ]) ?>
        </div>
    </div>
    <?= $this->AdminLteForm->textareaInput('message', [
        'label' => ['text' => 'Message'],
        'rows' => 5
    ]) ?>
</div>
<div class="card-footer text-right">
    <?= $this->AdminLteForm->submitButton('Envoyer') ?>
</div>
<?= $this->Form->end() ?>
```

### Formulaire avec Upload

```php
<?= $this->Form->create(null, ['enctype' => 'multipart/form-data']) ?>
<div class="card-body">
    <?= $this->AdminLteForm->textInput('title', [
        'label' => ['text' => 'Titre']
    ]) ?>
    <?= $this->AdminLteForm->fileInput('document', [
        'label' => ['text' => 'Document PDF'],
        'templateVars' => ['buttonText' => 'Choisir']
    ]) ?>
</div>
<?= $this->Form->end() ?>
```

### Sélecteur Multiple

```php
<?= $this->AdminLteForm->selectMultipleInput('skills', [
    'label' => ['text' => 'Compétences techniques'],
    'options' => [
        'php' => 'PHP',
        'javascript' => 'JavaScript',
        'python' => 'Python',
        'java' => 'Java'
    ],
    'templateVars' => ['icon' => 'fas fa-code']
]) ?>
```

### Switches (Toggle)

```php
<!-- Switch pour notifications -->
<?= $this->AdminLteForm->switchInput('notifications', [
    'label' => ['text' => 'Recevoir les notifications'],
    'checked' => true
]) ?>

<!-- Switch pour mode sombre -->
<?= $this->AdminLteForm->switchInput('dark_mode', [
    'label' => ['text' => 'Mode sombre activé'],
    'checked' => false
]) ?>
```

### Boutons Radio Groupés

```php
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

## ⚠️ Points Importants

1. **Charger le helper** dans `AppController::beforeRender()`
2. **Upload de fichiers** : Ajouter `enctype="multipart/form-data"` au formulaire
3. **Boutons radio** : Utiliser le même `name` pour les grouper
4. **Sélecteurs multiples** : Support Ctrl/Cmd+clic pour sélection multiple
5. **Switches** : Utiliser `checked` pour l'état initial
6. **Icônes** : FontAwesome doit être chargé
7. **Bootstrap** : AdminLTE nécessite Bootstrap 5

## 🎯 Exemples Complets

- **Contact** : `http://localhost:8765/form-builder/contact`
- **Inscription** : `http://localhost:8765/form-builder/register`
- **Profil** : `http://localhost:8765/form-builder/profile`
- **Recherche** : `http://localhost:8765/form-builder/search`
- **Sélecteurs Multiples** : `http://localhost:8765/form-builder/multiple`
- **Switches** : `http://localhost:8765/form-builder/switches`

## 📚 Documentation Complète

Voir `FORMBUILDER.md` pour la documentation détaillée.

---

**FormBuilder AdminLTE** - Créez des formulaires élégants en quelques lignes ! 🎉
