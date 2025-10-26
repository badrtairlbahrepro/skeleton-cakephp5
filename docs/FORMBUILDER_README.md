# FormBuilder AdminLTE

Un helper CakePHP pour créer facilement des formulaires élégants avec le style AdminLTE.

## 🎯 Fonctionnalités

- ✅ **12 méthodes** pour tous les types de champs
- 🎨 **Style AdminLTE** intégré
- 🔧 **Helper CakePHP** natif
- 📱 **Responsive** avec Bootstrap 5
- 🎯 **Icônes FontAwesome** automatiques
- 🔄 **Input Groups** avec icônes
- 📁 **Upload de fichiers** avec prévisualisation
- 🔀 **Sélecteurs multiples** avec Ctrl/Cmd+clic
- 🎛️ **Switches (Toggle)** animés
- ✅ **Validation** Bootstrap

## 🚀 Installation

### 1. Charger le Helper

```php
// src/Controller/AppController.php
public function beforeRender(\Cake\Event\EventInterface $event): void
{
    parent::beforeRender($event);
    $this->viewBuilder()->addHelper('AdminLteForm');
}
```

### 2. Inclure les Assets

```html
<!-- CSS AdminLTE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- jQuery + Bootstrap + AdminLTE -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
```

## 📋 Méthodes Disponibles

| Méthode | Description | Exemple |
|---------|-------------|---------|
| `textInput()` | Champ texte avec icône | `$this->AdminLteForm->textInput('name')` |
| `emailInput()` | Champ email | `$this->AdminLteForm->emailInput('email')` |
| `passwordInput()` | Mot de passe avec toggle | `$this->AdminLteForm->passwordInput('password')` |
| `textareaInput()` | Zone de texte | `$this->AdminLteForm->textareaInput('message')` |
| `fileInput()` | Upload de fichier | `$this->AdminLteForm->fileInput('avatar')` |
| `selectInput()` | Liste déroulante | `$this->AdminLteForm->selectInput('country')` |
| `selectMultipleInput()` | Sélecteur multiple | `$this->AdminLteForm->selectMultipleInput('skills')` |
| `checkboxInput()` | Case à cocher | `$this->AdminLteForm->checkboxInput('newsletter')` |
| `radioInput()` | Bouton radio | `$this->AdminLteForm->radioInput('theme')` |
| `switchInput()` | Switch (Toggle) | `$this->AdminLteForm->switchInput('notifications')` |
| `submitButton()` | Bouton d'envoi | `$this->AdminLteForm->submitButton('Envoyer')` |
| `resetButton()` | Bouton reset | `$this->AdminLteForm->resetButton('Annuler')` |

## 💡 Exemple Rapide

```php
<?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
<div class="card-body">
    <!-- Champ texte -->
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

    <!-- Mot de passe -->
    <?= $this->AdminLteForm->passwordInput('password', [
        'label' => ['text' => 'Mot de passe']
    ]) ?>

    <!-- Zone de texte -->
    <?= $this->AdminLteForm->textareaInput('message', [
        'label' => ['text' => 'Message'],
        'rows' => 4
    ]) ?>

    <!-- Upload de fichier -->
    <?= $this->AdminLteForm->fileInput('avatar', [
        'label' => ['text' => 'Photo de profil']
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

    <!-- Case à cocher -->
    <?= $this->AdminLteForm->checkboxInput('newsletter', [
        'label' => ['text' => 'Newsletter']
    ]) ?>

    <!-- Switch (Toggle) -->
    <?= $this->AdminLteForm->switchInput('notifications', [
        'label' => ['text' => 'Recevoir les notifications'],
        'checked' => true
    ]) ?>

    <!-- Boutons radio -->
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
</div>
<div class="card-footer text-right">
    <?= $this->AdminLteForm->resetButton('Annuler', ['class' => 'btn btn-secondary mr-2']) ?>
    <?= $this->AdminLteForm->submitButton('Envoyer', ['class' => 'btn btn-primary']) ?>
</div>
<?= $this->Form->end() ?>
```

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

## 🔧 Exemples Complets

- **Contact** : `http://localhost:8765/form-builder/contact`
- **Inscription** : `http://localhost:8765/form-builder/register`
- **Profil** : `http://localhost:8765/form-builder/profile`
- **Recherche** : `http://localhost:8765/form-builder/search`
- **Sélecteurs Multiples** : `http://localhost:8765/form-builder/multiple`
- **Switches** : `http://localhost:8765/form-builder/switches`

## 📚 Documentation

- **Guide Rapide** : [FORMBUILDER_QUICKSTART.md](FORMBUILDER_QUICKSTART.md)
- **Documentation Complète** : [FORMBUILDER.md](FORMBUILDER.md)

## ⚠️ Points Importants

1. **Charger le helper** dans `AppController::beforeRender()`
2. **Upload de fichiers** : Ajouter `enctype="multipart/form-data"` au formulaire
3. **Boutons radio** : Utiliser le même `name` pour les grouper
4. **Icônes** : FontAwesome doit être chargé
5. **Bootstrap** : AdminLTE nécessite Bootstrap 5

## 🐛 Dépannage

### Labels dupliqués
```php
// ❌ Incorrect
<?= $this->AdminLteForm->textInput('name', ['label' => 'Nom']) ?>

// ✅ Correct
<?= $this->AdminLteForm->textInput('name', [
    'label' => ['text' => 'Nom'],
    'div' => false
]) ?>
```

### Upload de fichiers
```php
// ✅ Correct
<?= $this->Form->create(null, ['enctype' => 'multipart/form-data']) ?>
```

### Boutons radio groupés
```php
// ✅ Correct - Même 'name' pour tous les boutons du groupe
<?= $this->AdminLteForm->radioInput('theme', [
    'label' => ['text' => 'Clair'],
    'value' => 'light',
    'name' => 'theme' // ← Même nom
]) ?>
```

### Sélecteurs multiples
```php
// ✅ Correct - Support Ctrl/Cmd+clic
<?= $this->AdminLteForm->selectMultipleInput('skills', [
    'label' => ['text' => 'Compétences'],
    'options' => [
        'php' => 'PHP',
        'javascript' => 'JavaScript'
    ]
]) ?>
```

### Switches (Toggle)
```php
// ✅ Correct - Toggle animé
<?= $this->AdminLteForm->switchInput('notifications', [
    'label' => ['text' => 'Notifications'],
    'checked' => true
]) ?>
```

## 🎉 Avantages

- **Rapide** : Créez des formulaires en quelques lignes
- **Cohérent** : Style AdminLTE uniforme
- **Flexible** : Options personnalisables
- **Moderne** : Bootstrap 5 + FontAwesome
- **Fonctionnel** : JavaScript automatique pour les fonctionnalités avancées

---

**FormBuilder AdminLTE** - Simplifiez vos formulaires CakePHP ! 🚀
