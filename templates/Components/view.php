<?php
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-2">
                <i class="fas <?= $component['icon'] ?>"></i>
                <?= $component['name'] ?>
            </h1>
            <p class="text-muted">
                <?= $component['description'] ?? '' ?>
            </p>
        </div>
    </div>

    <div class="row">
        <?php foreach ($variants as $variant): ?>
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <!-- Header avec titre et description -->
                    <div class="card-header bg-light">
                        <h5 class="mb-1" style="font-weight: 600;">
                            <?= $variant['label'] ?>
                        </h5>
                        <small class="text-muted">
                            <?= $variant['description'] ?>
                        </small>
                    </div>

                    <!-- Prévisualisation du composant -->
                    <div class="card-body bg-white d-flex align-items-center justify-content-center" style="min-height: 150px; border-bottom: 1px solid #e3e6f0;">
                        <div class="component-preview w-100" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 10px; padding: 20px;">
                            <?php if ($group === 'modals'): ?>
                                <!-- For modals, show a button to trigger the modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-preview-<?= $variant['id'] ?>">
                                    <i class="fas fa-expand"></i> Ouvrir la Modale
                                </button>
                                
                                <!-- Script to append modal to body -->
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var modalHTML = `<?= str_replace(array('"', '`'), array('\\"', '\\`'), $variant['code']) ?>`;
                                    
                                    // Create a temporary container to parse the HTML
                                    var tempDiv = document.createElement('div');
                                    tempDiv.innerHTML = modalHTML;
                                    
                                    // Get the modal element
                                    var modal = tempDiv.querySelector('.modal');
                                    
                                    if (modal) {
                                        // Append modal to body so Bootstrap can find it
                                        document.body.appendChild(modal);
                                        
                                        // Initialize Bootstrap Modal
                                        var bootstrapModal = new bootstrap.Modal(modal);
                                    }
                                });
                                </script>
                                   <?php elseif ($group === 'progress'): ?>
                                       <!-- Special handling for progress bars to display them properly -->
                                       <div style="width: 100%;">
                                           <?= $variant['code'] ?>
                                       </div>
                                   <?php elseif ($group === 'forms'): ?>
                                       <!-- Special handling for forms to display them properly with input-group styling -->
                                       <div style="width: 100%; max-width: 500px;">
                                           <?= $variant['code'] ?>
                                       </div>
                                   <?php elseif ($group === 'spinners'): ?>
                                       <!-- Special handling for spinners to display them properly -->
                                       <?= $variant['code'] ?>
                                   <?php else: ?>
                                       <?= $variant['code'] ?>
                                   <?php endif; ?>
                        </div>
                    </div>

                    <!-- Code HTML -->
                    <div class="card-footer">
                        <div class="form-group mb-0">
                            <label class="mb-2" style="font-weight: 600; font-size: 0.9rem;">
                                <i class="fas fa-code"></i> Code HTML:
                            </label>
                            <textarea 
                                class="form-control code-snippet" 
                                rows="5" 
                                readonly
                                style="font-family: 'Courier New', monospace; font-size: 0.85rem;">
<?= htmlspecialchars($variant['code']) ?>
                            </textarea>
                            <button 
                                class="btn btn-outline-primary btn-sm mt-2 copy-btn" 
                                data-text="<?= htmlspecialchars($variant['code']) ?>"
                                title="Copier le code dans le presse-papiers">
                                <i class="fas fa-copy"></i> Copier le code
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.component-preview {
    padding: 15px;
}

.component-preview button,
.component-preview input,
.component-preview select,
.component-preview .badge,
.component-preview .badge-primary {
    margin-right: 5px;
    margin-bottom: 5px;
}

.component-preview .card {
    margin-bottom: 15px;
}

/* Spinner styles for better visibility */
.component-preview .spinner-border {
    border-width: 0.25em;
    width: 3rem;
    height: 3rem;
}

.component-preview .spinner-grow {
    width: 3rem;
    height: 3rem;
}

.component-preview .spinner-border-sm {
    width: 1.5rem;
    height: 1.5rem;
    border-width: 0.2em;
}

/* Custom file input styles (AdminLTE) */
.component-preview .custom-file {
    position: relative;
    display: flex;
    width: 100%;
    height: 40px;
    margin-bottom: 0;
    flex: 1;
}

.component-preview .custom-file-input {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 40px;
    margin: 0;
    opacity: 0;
    cursor: pointer;
}

.component-preview .custom-file-label {
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

.component-preview .custom-file-label::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    display: flex;
    align-items: center;
    height: 40px;
    padding: 8px 12px;
    line-height: 1.5;
    color: #495057;
    content: "Browse";
    background-color: #e9ecef;
    border-left: 1px solid #ced4da;
    border-radius: 0;
    white-space: nowrap;
}

.component-preview .input-group .custom-file {
    border-radius: 0;
}

.component-preview .input-group .custom-file-label {
    border-radius: 0;
}

.component-preview .input-group .custom-file-label::after {
    border-radius: 0;
}

.component-preview .input-group-append .input-group-text {
    border-left: 0;
    border-radius: 0 4px 4px 0;
    height: 40px;
    display: flex;
    align-items: center;
}

/* Form styles for better visibility */
.component-preview .form-group {
    margin-bottom: 20px;
}

.component-preview .form-group label {
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
    display: block;
}

.component-preview .form-control {
    height: 40px;
    font-size: 14px;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 0;
    width: 100%;
    flex: 1;
}

.component-preview .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.component-preview .input-group {
    width: 100%;
    margin-bottom: 15px;
    display: flex;
    align-items: stretch;
}

.component-preview .input-group-prepend {
    display: flex;
}

.component-preview .input-group-append {
    display: flex;
}

.component-preview .input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    color: #495057;
    font-weight: 500;
    display: flex;
    align-items: center;
    padding: 8px 12px;
    white-space: nowrap;
}

.component-preview .input-group-prepend .input-group-text {
    border-right: 0;
    border-radius: 4px 0 0 4px;
}

.component-preview .input-group-append .input-group-text {
    border-left: 0;
    border-radius: 0 4px 4px 0;
}

.component-preview .input-group .form-control {
    border-radius: 0;
}

.component-preview .input-group .form-control:first-child {
    border-radius: 4px 0 0 4px;
}

.component-preview .input-group .form-control:last-child {
    border-radius: 0 4px 4px 0;
}

.component-preview .input-group .form-control:only-child {
    border-radius: 4px;
}

.component-preview .btn {
    padding: 8px 16px;
    font-size: 14px;
    border-radius: 0;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.component-preview .input-group-append .btn {
    border-radius: 0 4px 4px 0;
    border-left: 0;
}

.component-preview .form-check {
    margin-bottom: 15px;
    padding-left: 25px;
}

.component-preview .form-check-input {
    margin-left: -25px;
    margin-top: 0.25rem;
}

.component-preview .form-check-label {
    font-weight: 500;
    cursor: pointer;
}

/* Fix for textarea in input-group */
.component-preview .input-group textarea.form-control {
    height: auto;
    min-height: 40px;
    resize: vertical;
}

/* Progress bar styles for better visibility */
.component-preview .progress {
    height: 20px;
    margin-bottom: 15px;
    background-color: #f5f5f5;
    border-radius: 4px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    display: block !important;
}

.component-preview .progress-bar {
    background-color: #007bff;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    text-align: center;
    color: white;
    font-weight: bold;
    display: block !important;
    transition: width 0.6s ease;
}

.component-preview .progress-bar.bg-success {
    background-color: #28a745 !important;
}

.component-preview .progress-bar.bg-warning {
    background-color: #ffc107 !important;
    color: #333 !important;
}

.component-preview .progress-bar.bg-danger {
    background-color: #dc3545 !important;
}

.component-preview .progress-bar.bg-primary {
    background-color: #007bff !important;
}

.component-preview .progress-bar-striped {
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent) !important;
    background-size: 40px 40px;
}

.component-preview .progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite;
}

@keyframes progress-bar-stripes {
    from {
        background-position: 40px 0;
    }
    to {
        background-position: 0 0;
    }
}

.copy-btn {
    transition: all 0.3s ease;
}

.copy-btn:hover {
    background-color: #007bff;
    color: white;
}

.copy-btn.copied {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
}

.code-snippet {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    color: #333;
}
</style>

<script>
document.querySelectorAll('.copy-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const text = this.getAttribute('data-text');
        
        // Copier dans le presse-papiers
        navigator.clipboard.writeText(text).then(() => {
            // Feedback visuel
            const originalHTML = this.innerHTML;
            const originalClass = this.className;
            
            this.innerHTML = '<i class="fas fa-check"></i> Copié!';
            this.classList.add('copied');
            
            // Restaurer après 2 secondes
            setTimeout(() => {
                this.innerHTML = originalHTML;
                this.className = originalClass;
            }, 2000);
        }).catch(err => {
            console.error('Erreur lors de la copie:', err);
            alert('Erreur: Impossible de copier le code');
        });
    });
});
</script>
