# 🔗 Git Hooks - Tests Automatiques

## 📖 Table des Matières

1. [Qu'est-ce qu'un Git Hook ?](#quest-ce-quun-git-hook)
2. [Pré-Push Hook Installé](#pré-push-hook-installé)
3. [Comment ça Fonctionne ?](#comment-ça-fonctionne)
4. [Utilisation](#utilisation)
5. [Contournement (Si Nécessaire)](#contournement-si-nécessaire)
6. [Configuration Personnalisée](#configuration-personnalisée)

---

## 🤔 Qu'est-ce qu'un Git Hook ?

### Définition Simple

Un **Git Hook** est un **script qui s'exécute automatiquement** à des moments précis de votre workflow Git.

**Analogie :** Comme un "portier" qui vérifie votre code avant de vous laisser entrer.

### Les Hooks Disponibles

```
pre-commit   → Avant de faire un commit
pre-push     → Avant de pusher vers le serveur
pre-rebase   → Avant de rebaser
post-commit  → Après avoir commité
etc.
```

**Dans notre cas :** Nous utilisons **pre-push** pour lancer les tests **avant** chaque push.

### Pourquoi ?

Sans hook, vous pouvez pusher du code défectueux qui :
- ❌ Fait planter les tests
- ❌ Ne respecte pas les standards de code
- ❌ Contient des bugs

Avec hook, vous ne pouvez pusher que du code **validé** :
- ✅ Tous les tests passent
- ✅ Le style de code est correct
- ✅ L'analyse statique est OK

---

## 🎯 Pré-Push Hook Installé

### Ce qui est Vérifié

Notre hook **pre-push** lance automatiquement :

#### 1. **Tests PHPUnit** (`composer test`)

```
• Vérifie que tous les tests unitaires passent
• Assure que la logique métier fonctionne
• Garantit la qualité du code
```

#### 2. **Vérification PSR-12** (`composer cs-check`)

```
• Vérifie le style de code
• Assure la conformité PSR-12
• Garantit la lisibilité
```

#### 3. **Analyse Statique** (`composer stan`)

```
• Détecte les erreurs potentielles
• Identifie les bugs avant l'exécution
• Améliore la qualité du code
```

### Ordre d'Exécution

```
1. Tests PHPUnit
   ↓ (si OK)
2. Vérification PSR-12
   ↓ (si OK)
3. Analyse Statique PHPStan
   ↓ (si OK)
4. Push autorisé ✅
```

---

## 🚀 Comment ça Fonctionne ?

### Scénario 1 : Tests Réussis

```bash
$ git push

╔════════════════════════════════════════════════════════════════════════════╗
║           🧪 LANCMENT AUTOMATIQUE DES TESTS...                       ║
╚════════════════════════════════════════════════════════════════════════════╝

📋 Étape 1/3 : Tests PHPUnit
✅ Tous les tests PHPUnit ont réussi!

📋 Étape 2/3 : Vérification PSR-12
✅ Le style de code est conforme!

📋 Étape 3/3 : Analyse statique
✅ L'analyse statique est OK!

╔════════════════════════════════════════════════════════════════════════════╗
║              ✅ TOUS LES TESTS ONT RÉUSSI!                         ║
╚════════════════════════════════════════════════════════════════════════════╝

Enumerating objects: 25, done.
Counting objects: 100% (25/25), done.
Writing objects: 100% (15/15), done.
```

**Résultat :** Push réussi ! 🎉

---

### Scénario 2 : Tests Échoués

```bash
$ git push

╔════════════════════════════════════════════════════════════════════════════╗
║           🧪 LANCMENT AUTOMATIQUE DES TESTS...                       ║
╚════════════════════════════════════════════════════════════════════════════╝

📋 Étape 1/3 : Tests PHPUnit
❌ Les tests PHPUnit ont échoué!

⚠️  Pour pusher quand même, utilisez:
    git push --no-verify
```

**Résultat :** Push bloqué ! 🚫

---

## 💡 Utilisation

### Automatique (Recommandé)

Le hook s'exécute **automatiquement** à chaque `git push`.

Vous n'avez **rien à faire**, il se lance tout seul !

```bash
# Tentative de push normale
git push

# Si les tests passent → Push réussi ✅
# Si les tests échouent → Push bloqué ❌
```

### Avantages

✅ **Protection automatique** : Impossible de pusher du code défectueux
✅ **Qualité garantie** : Tous les pushs respectent les standards
✅ **Détection précoce** : Erreurs détectées avant le push
✅ **Workflow uniforme** : Toute l'équipe suit les mêmes règles

---

## 🚫 Contournement (Si Nécessaire)

### Quand Contourner ?

Dans certains cas **exceptionnels**, vous pouvez contourner le hook :

1. **Code de debug temporaire** qui sera retiré immédiatement
2. **Work in progress** partagé avec l'équipe
3. **Urgence critique** nécessitant un déploiement immédiat

### ⚠️ ATTENTION

**Ne contournez le hook qu'en cas d'urgence absolue !**

Code non testé = Bugs potentiels = Problèmes en production !

### Commande de Contournement

```bash
# Contourner le hook pre-push
git push --no-verify

# Ou version courte
git push -n
```

**Bonne pratique :** Après avoir poussé, lancez les tests manuellement :
```bash
composer check
```

---

## ⚙️ Configuration Personnalisée

### Modifier le Hook

Le fichier du hook se trouve dans :
```
.git/hooks/pre-push
```

**Pour modifier :**
1. Éditez le fichier `.git/hooks/pre-push`
2. Ajoutez ou supprimez des vérifications
3. Sauvegardez

**Exemple :** Ajouter une vérification Git Lint

```bash
# Dans .git/hooks/pre-push

echo "📋 Étape 4/4 : Vérification Git Lint"
git-lint
EXIT_CODE=$?

if [ $EXIT_CODE -ne 0 ]; then
    error "Git Lint a échoué!"
    exit 1
fi
```

### Personnaliser les Messages

Vous pouvez modifier les messages affichés :

```bash
# Changer le message de succès
success "Votre message personnalisé!"

# Changer le message d'erreur
error "Votre message d'erreur!"
```

### Ajouter des Notifications

Envoie un email en cas d'échec :

```bash
# Dans .git/hooks/pre-push
if [ $EXIT_CODE -ne 0 ]; then
    error "Les tests ont échoué!"
    echo "Envoi d'une notification email..."
    mail -s "Tests échoués" team@example.com <<< "Les tests ont échoué lors du push"
    exit 1
fi
```

---

## 🔧 Dépannage

### Le Hook ne se Lance Pas

**Problème :** Le hook ne s'exécute pas automatiquement.

**Solution :** Vérifier que le fichier est exécutable :

```bash
# Vérifier les permissions
ls -l .git/hooks/pre-push

# Si pas exécutable, rendre exécutable
chmod +x .git/hooks/pre-push
```

### Permissions Refusées

**Problème :** "Permission denied" lors de l'exécution.

**Solution :**

```bash
# Donner les permissions d'exécution
chmod +x .git/hooks/pre-push

# Si toujours bloqué, vérifier les permissions du dossier
chmod 755 .git/hooks/
```

### Tests Trop Longs

**Problème :** Les tests prennent trop de temps et ralentissent les pushs.

**Solution :** Lancer seulement les tests essentiels dans le hook :

```bash
# Dans .git/hooks/pre-push, remplacer:
composer test

# Par:
php vendor/bin/phpunit --filter='critical'
```

### Désactiver Temporairement

**En cas d'urgence :**

```bash
# Renommer le fichier pour le désactiver
mv .git/hooks/pre-push .git/hooks/pre-push.disabled

# Le réactiver plus tard
mv .git/hooks/pre-push.disabled .git/hooks/pre-push
```

---

## 📊 Résumé

### Ce qui se Passe à Chaque Push

```
1. Vous faites: git push
                ↓
2. Git lance: .git/hooks/pre-push
                ↓
3. Tests s'exécutent:
   • PHPUnit (composer test)
   • PSR-12 (composer cs-check)
   • PHPStan (composer stan)
                ↓
4a. Tous passent → Push réussi ✅
4b. Un échoue → Push bloqué ❌
```

### Commandes Essentielles

```bash
# Push normal (avec hook)
git push

# Contourner le hook
git push --no-verify

# Lancer les tests manuellement
composer check

# Voir le fichier du hook
cat .git/hooks/pre-push
```

---

## ✅ Bonnes Pratiques

1. **Lancez les tests avant de push**
   ```bash
   composer check
   git add .
   git commit -m "Your message"
   git push
   ```

2. **Ne contournez le hook qu'en cas d'urgence**
   - Toujours essayer de corriger les erreurs d'abord
   - Si contournement, lancer `composer check` après

3. **Communiquez avec l'équipe**
   - Si les tests échouent souvent, discutez-en avec l'équipe
   - Peut-être besoin d'ajuster les tests

4. **Mettez à jour le hook si nécessaire**
   - Ajoutez des vérifications importantes
   - Améliorez les messages d'erreur

---

## 🎓 Conclusion

Avec le hook **pre-push**, vous avez :

✅ **Protection automatique** contre le code défectueux
✅ **Qualité garantie** de tous les pushs
✅ **Détection précoce** des erreurs
✅ **Workflow uniforme** pour toute l'équipe

**Ne pushez plus de code cassé ! 🚀**

---

**📝 Note :** Ce hook protège votre projet et garantit que seul du code de qualité arrive dans le dépôt distant.
