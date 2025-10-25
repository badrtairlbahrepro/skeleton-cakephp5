<?php
/**
 * @var \App\View\AppView $this
 * @var array $searchData
 */
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-2">
                <i class="fas fa-search"></i> Formulaire de Recherche
            </h1>
            <p class="text-muted">
                Exemple d'utilisation du FormBuilder AdminLTE pour créer un formulaire de recherche avancée.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recherche Avancée</h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(null, ['class' => 'form-horizontal', 'method' => 'get']) ?>
                    
                    <div class="form-group">
                        <?= $this->AdminLteForm->textInput('keywords', [
                            'label' => ['text' => 'Mots-clés'],
                            'placeholder' => 'Entrez vos mots-clés de recherche...',
                            'value' => $searchData['keywords'] ?? '',
                            'templateVars' => ['icon' => 'fas fa-search']
                        ]) ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->selectInput('category', [
                                'label' => ['text' => 'Catégorie'],
                                'options' => [
                                    'web' => 'Développement Web',
                                    'mobile' => 'Applications Mobiles',
                                    'desktop' => 'Applications Desktop',
                                    'ai' => 'Intelligence Artificielle',
                                    'data' => 'Data Science',
                                    'security' => 'Sécurité',
                                    'devops' => 'DevOps',
                                    'design' => 'Design'
                                ],
                                'value' => $searchData['category'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-tags']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->selectInput('status', [
                                'label' => ['text' => 'Statut'],
                                'options' => [
                                    'active' => 'Actif',
                                    'inactive' => 'Inactif',
                                    'pending' => 'En attente',
                                    'archived' => 'Archivé'
                                ],
                                'value' => $searchData['status'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-info-circle']
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('date_from', [
                                'label' => ['text' => 'Date de début'],
                                'type' => 'date',
                                'value' => $searchData['date_from'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-calendar-alt']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('date_to', [
                                'label' => ['text' => 'Date de fin'],
                                'type' => 'date',
                                'value' => $searchData['date_to'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-calendar-alt']
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->selectInput('file_type', [
                                'label' => ['text' => 'Type de fichier'],
                                'options' => [
                                    'pdf' => 'PDF',
                                    'doc' => 'Document Word',
                                    'xls' => 'Feuille de calcul',
                                    'ppt' => 'Présentation',
                                    'image' => 'Image',
                                    'video' => 'Vidéo',
                                    'audio' => 'Audio',
                                    'archive' => 'Archive'
                                ],
                                'value' => $searchData['file_type'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-file']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->selectInput('sort_by', [
                                'label' => ['text' => 'Trier par'],
                                'options' => [
                                    'relevance' => 'Pertinence',
                                    'date_asc' => 'Date (plus ancien)',
                                    'date_desc' => 'Date (plus récent)',
                                    'name_asc' => 'Nom (A-Z)',
                                    'name_desc' => 'Nom (Z-A)',
                                    'size_asc' => 'Taille (plus petit)',
                                    'size_desc' => 'Taille (plus grand)'
                                ],
                                'value' => 'relevance',
                                'templateVars' => ['icon' => 'fas fa-sort']
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Filtres avancés</label>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $this->AdminLteForm->checkboxInput('exact_match', [
                                    'label' => ['text' => 'Correspondance exacte'],
                                    'value' => '1'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->AdminLteForm->checkboxInput('case_sensitive', [
                                    'label' => ['text' => 'Sensible à la casse'],
                                    'value' => '1'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->AdminLteForm->checkboxInput('include_archived', [
                                    'label' => ['text' => 'Inclure les archives'],
                                    'value' => '1'
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <?= $this->AdminLteForm->fileInput('upload_file', [
                        'label' => ['text' => 'Rechercher dans un fichier'],
                        'templateVars' => ['icon' => 'fas fa-upload']
                    ]) ?>

                    <div class="form-group">
                        <?= $this->AdminLteForm->textareaInput('advanced_query', [
                            'label' => ['text' => 'Requête avancée (JSON)'],
                            'placeholder' => '{"field": "value", "operator": "contains"}',
                            'rows' => 3,
                            'templateVars' => ['icon' => 'fas fa-code']
                        ]) ?>
                    </div>

                    <div class="form-group text-right">
                        <?= $this->AdminLteForm->resetButton('Réinitialiser', ['class' => 'btn btn-secondary mr-2']) ?>
                        <?= $this->AdminLteForm->submitButton('Rechercher', ['class' => 'btn btn-primary mr-2']) ?>
                        <?= $this->AdminLteForm->submitButton('Exporter', ['class' => 'btn btn-success', 'name' => 'export']) ?>
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
                    <h6>Champ Date :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->textInput(\'date_from\', [
    \'label\' => [\'text\' => \'Date de début\'],
    \'type\' => \'date\',
    \'templateVars\' => [\'icon\' => \'fas fa-calendar-alt\']
]) ?>') ?></code></pre>

                    <h6>Cases à Cocher :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->checkboxInput(\'exact_match\', [
    \'label\' => [\'text\' => \'Correspondance exacte\'],
    \'value\' => \'1\'
]) ?>') ?></code></pre>

                    <h6>Boutons Multiples :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->submitButton(\'Rechercher\', [
    \'class\' => \'btn btn-primary\'
]) ?>
<?= $this->AdminLteForm->submitButton(\'Exporter\', [
    \'class\' => \'btn btn-success\',
    \'name\' => \'export\'
]) ?>') ?></code></pre>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Fonctionnalités</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Recherche par mots-clés</li>
                        <li><i class="fas fa-check text-success"></i> Filtres par catégorie</li>
                        <li><i class="fas fa-check text-success"></i> Plage de dates</li>
                        <li><i class="fas fa-check text-success"></i> Type de fichier</li>
                        <li><i class="fas fa-check text-success"></i> Options de tri</li>
                        <li><i class="fas fa-check text-success"></i> Filtres avancés</li>
                        <li><i class="fas fa-check text-success"></i> Upload de fichier</li>
                        <li><i class="fas fa-check text-success"></i> Requête JSON</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
