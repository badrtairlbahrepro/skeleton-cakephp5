<?php
/**
 * @var \App\View\AppView $this
 * @var array $multipleData
 */
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-2">
                <i class="fas fa-list-check"></i> Sélecteurs Multiples
            </h1>
            <p class="text-muted">
                Exemple d'utilisation du FormBuilder AdminLTE pour créer des sélecteurs multiples.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulaire avec Sélecteurs Multiples</h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
                    
                    <div class="form-group">
                        <label class="form-label">Compétences techniques</label>
                        <?= $this->AdminLteForm->selectMultipleInput('skills', [
                            'label' => ['text' => 'Sélectionnez vos compétences'],
                            'options' => [
                                'php' => 'PHP',
                                'javascript' => 'JavaScript',
                                'python' => 'Python',
                                'java' => 'Java',
                                'csharp' => 'C#',
                                'ruby' => 'Ruby',
                                'go' => 'Go',
                                'rust' => 'Rust'
                            ],
                            'templateVars' => ['icon' => 'fas fa-code']
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Langues parlées</label>
                        <?= $this->AdminLteForm->selectMultipleInput('languages', [
                            'label' => ['text' => 'Sélectionnez les langues'],
                            'options' => [
                                'fr' => 'Français',
                                'en' => 'Anglais',
                                'es' => 'Espagnol',
                                'de' => 'Allemand',
                                'it' => 'Italien',
                                'pt' => 'Portugais',
                                'ru' => 'Russe',
                                'zh' => 'Chinois'
                            ],
                            'templateVars' => ['icon' => 'fas fa-globe']
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Centres d'intérêt</label>
                        <?= $this->AdminLteForm->selectMultipleInput('interests', [
                            'label' => ['text' => 'Sélectionnez vos centres d\'intérêt'],
                            'options' => [
                                'web' => 'Développement Web',
                                'mobile' => 'Développement Mobile',
                                'ai' => 'Intelligence Artificielle',
                                'blockchain' => 'Blockchain',
                                'iot' => 'Internet des Objets',
                                'gaming' => 'Jeux Vidéo',
                                'security' => 'Cybersécurité',
                                'data' => 'Data Science'
                            ],
                            'templateVars' => ['icon' => 'fas fa-heart']
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Niveau d'expérience</label>
                        <?= $this->AdminLteForm->selectInput('experience_level', [
                            'label' => ['text' => 'Niveau d\'expérience'],
                            'options' => [
                                'junior' => 'Junior (0-2 ans)',
                                'intermediate' => 'Intermédiaire (2-5 ans)',
                                'senior' => 'Senior (5-10 ans)',
                                'expert' => 'Expert (10+ ans)'
                            ],
                            'templateVars' => ['icon' => 'fas fa-chart-line']
                        ]) ?>
                    </div>

                    <div class="form-group text-right">
                        <?= $this->AdminLteForm->resetButton('Réinitialiser', ['class' => 'btn btn-secondary mr-2']) ?>
                        <?= $this->AdminLteForm->submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Code Source</h3>
                </div>
                <div class="card-body">
                    <h6>Sélecteur Multiple :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->selectMultipleInput(\'skills\', [
    \'label\' => [\'text\' => \'Sélectionnez vos compétences\'],
    \'options\' => [
        \'php\' => \'PHP\',
        \'javascript\' => \'JavaScript\',
        \'python\' => \'Python\'
    ],
    \'templateVars\' => [\'icon\' => \'fas fa-code\']
]) ?>') ?></code></pre>

                    <h6>Sélecteur Simple :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->selectInput(\'experience_level\', [
    \'label\' => [\'text\' => \'Niveau d\\\'expérience\'],
    \'options\' => [
        \'junior\' => \'Junior (0-2 ans)\',
        \'senior\' => \'Senior (5-10 ans)\'
    ]
]) ?>') ?></code></pre>

                    <h6>Boutons :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->submitButton(\'Sauvegarder\', [
    \'class\' => \'btn btn-success\'
]) ?>') ?></code></pre>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Fonctionnalités</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Sélection multiple</li>
                        <li><i class="fas fa-check text-success"></i> Icônes personnalisées</li>
                        <li><i class="fas fa-check text-success"></i> Style AdminLTE</li>
                        <li><i class="fas fa-check text-success"></i> Validation HTML5</li>
                        <li><i class="fas fa-check text-success"></i> Support Ctrl/Cmd+clic</li>
                        <li><i class="fas fa-check text-success"></i> Responsive design</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
