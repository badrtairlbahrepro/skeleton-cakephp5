<?php

declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * Helper AdminLTE pour les formulaires
 */
class AdminLteFormHelper extends Helper
{
    protected array $helpers = ['Form', 'Html'];

    /**
     * Champ texte avec icône
     */
    public function textInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'type' => 'text',
            'class' => 'form-control',
            'div' => false,
            'label' => false,
            'templateVars' => ['icon' => 'fas fa-user']
        ];

        $options = array_merge($defaultOptions, $options);
        $icon = $options['templateVars']['icon'] ?? 'fas fa-user';
        unset($options['templateVars']['icon']);

        $labelText = $options['label']['text'] ?? $fieldName;
        $label = $this->Html->tag('label', $labelText, ['for' => $fieldName]);

        $input = $this->Form->input($fieldName, $options);

        return $this->Html->tag(
            'div',
            $label .
            $this->Html->tag(
                'div',
                $this->Html->tag(
                    'div',
                    $this->Html->tag(
                        'span',
                        $this->Html->tag(
                            'i',
                            '',
                            ['class' => $icon]
                        ),
                        ['class' => 'input-group-text']
                    ),
                    ['class' => 'input-group-prepend']
                ) .
                $input,
                ['class' => 'input-group']
            ),
            ['class' => 'form-group']
        );
    }

    /**
     * Champ email avec icône
     */
    public function emailInput(string $fieldName, array $options = []): string
    {
        $options['type'] = 'email';
        $options['templateVars']['icon'] = 'fas fa-envelope';
        return $this->textInput($fieldName, $options);
    }

    /**
     * Champ mot de passe avec bouton afficher/masquer
     */
    public function passwordInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'type' => 'password',
            'class' => 'form-control',
            'div' => false,
            'label' => false,
            'templateVars' => ['icon' => 'fas fa-lock']
        ];

        $options = array_merge($defaultOptions, $options);
        $icon = $options['templateVars']['icon'] ?? 'fas fa-lock';
        unset($options['templateVars']['icon']);

        $labelText = $options['label']['text'] ?? $fieldName;
        $label = $this->Html->tag('label', $labelText, ['for' => $fieldName]);

        $inputId = $fieldName . '_' . uniqid();
        $options['id'] = $inputId;
        $input = $this->Form->input($fieldName, $options);

        $toggleButton = $this->Html->tag(
            'div',
            $this->Html->tag('button', $this->Html->tag('i', '', ['class' => 'fas fa-eye']), [
                'class' => 'btn btn-outline-secondary',
                'type' => 'button',
                'onclick' => "togglePassword('$inputId')"
            ]),
            ['class' => 'input-group-append']
        );

        $script = $this->Html->scriptBlock("
            function togglePassword(inputId) {
                var input = document.getElementById(inputId);
                var icon = event.target;
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash';
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye';
                }
            }
        ");

        return $this->Html->tag(
            'div',
            $label .
            $this->Html->tag(
                'div',
                $this->Html->tag(
                    'div',
                    $this->Html->tag(
                        'div',
                        $this->Html->tag(
                            'span',
                            $this->Html->tag('i', '', ['class' => $icon]),
                            ['class' => 'input-group-text']
                        ),
                        ['class' => 'input-group-prepend']
                    ) .
                    $input .
                    $toggleButton,
                    ['class' => 'input-group']
                ) .
                $script,
                ['class' => 'form-group']
            )
        );
    }

    /**
     * Zone de texte avec icône
     */
    public function textareaInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'type' => 'textarea',
            'class' => 'form-control',
            'div' => false,
            'label' => false,
            'templateVars' => ['icon' => 'fas fa-comment'],
            'rows' => 4
        ];

        $options = array_merge($defaultOptions, $options);
        $icon = $options['templateVars']['icon'] ?? 'fas fa-comment';
        unset($options['templateVars']['icon']);

        $labelText = $options['label']['text'] ?? $fieldName;
        $label = $this->Html->tag('label', $labelText, ['for' => $fieldName]);
        $input = $this->Form->input($fieldName, $options);

        return $this->Html->tag(
            'div',
            $label .
            $this->Html->tag(
                'div',
                $this->Html->tag(
                    'div',
                    $this->Html->tag(
                        'span',
                        $this->Html->tag('i', '', ['class' => $icon]),
                        ['class' => 'input-group-text']
                    ),
                    ['class' => 'input-group-prepend']
                ) .
                $input,
                ['class' => 'input-group']
            ),
            ['class' => 'form-group']
        );
    }

    /**
     * Champ fichier AdminLTE
     */
    public function fileInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'type' => 'file',
            'class' => 'custom-file-input',
            'div' => false,
            'label' => false,
            'templateVars' => ['buttonText' => 'Upload']
        ];

        $options = array_merge($defaultOptions, $options);
        $buttonText = $options['templateVars']['buttonText'] ?? 'Upload';
        unset($options['templateVars']['buttonText']);

        $labelText = $options['label']['text'] ?? ucfirst($fieldName);
        $label = $this->Html->tag('label', $labelText, ['for' => $fieldName]);

        $inputId = $fieldName . '_' . uniqid();
        $options['id'] = $inputId;
        $options['label'] = false;
        $fileInput = $this->Html->tag('input', '', array_merge($options, [
            'type' => 'file',
            'name' => $fieldName,
            'id' => $inputId
        ]));

        $customFile = $this->Html->tag(
            'div',
            $fileInput .
            $this->Html->tag('label', 'Choose file', [
                'class' => 'custom-file-label',
                'for' => $inputId,
                'id' => 'customFileLabel_' . $inputId
            ]),
            ['class' => 'custom-file']
        );

        $uploadButton = $this->Html->tag(
            'div',
            $this->Html->tag('span', $buttonText, ['class' => 'input-group-text']),
            ['class' => 'input-group-append']
        );

        $script = $this->Html->scriptBlock("
            document.getElementById('$inputId').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : 'Choose file';
                document.getElementById('customFileLabel_$inputId').textContent = fileName;
            });
        ");

        return $this->Html->tag(
            'div',
            $label .
            $this->Html->tag(
                'div',
                $customFile .
                $uploadButton,
                ['class' => 'input-group']
            ) .
            $script,
            ['class' => 'form-group']
        );
    }

    /**
     * Sélecteur avec icône
     */
    public function selectInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'class' => 'custom-select form-control',
            'div' => false,
            'label' => false,
            'templateVars' => ['icon' => 'fas fa-list'],
            'empty' => 'Sélectionner une option'
        ];

        $options = array_merge($defaultOptions, $options);
        $icon = $options['templateVars']['icon'] ?? 'fas fa-list';
        unset($options['templateVars']['icon']);

        $labelText = $options['label']['text'] ?? ucfirst($fieldName);
        $label = $this->Html->tag('label', $labelText, ['for' => $fieldName]);

        // Générer les options du select
        $selectOptions = '';
        if (isset($options['empty'])) {
            $selectOptions .= $this->Html->tag('option', $options['empty'], ['value' => '']);
        }

        if (isset($options['options'])) {
            foreach ($options['options'] as $value => $text) {
                $selectOptions .= $this->Html->tag('option', $text, ['value' => $value]);
            }
        }

        // Générer le select HTML
        $select = $this->Html->tag('select', $selectOptions, [
            'name' => $fieldName,
            'id' => $fieldName,
            'class' => 'custom-select form-control'
        ]);

        return $this->Html->tag(
            'div',
            $label .
            $this->Html->tag(
                'div',
                $this->Html->tag(
                    'div',
                    $this->Html->tag(
                        'span',
                        $this->Html->tag('i', '', ['class' => $icon]),
                        ['class' => 'input-group-text']
                    ),
                    ['class' => 'input-group-prepend']
                ) .
                $select,
                ['class' => 'input-group']
            ),
            ['class' => 'form-group']
        );
    }

    /**
     * Sélecteur multiple avec icône
     */
    public function selectMultipleInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'class' => 'custom-select',
            'div' => false,
            'label' => false,
            'templateVars' => ['icon' => 'fas fa-list'],
            'empty' => 'Sélectionner des options'
        ];

        $options = array_merge($defaultOptions, $options);
        $icon = $options['templateVars']['icon'] ?? 'fas fa-list';
        unset($options['templateVars']['icon']);

        $labelText = $options['label']['text'] ?? ucfirst($fieldName);
        $label = $this->Html->tag('label', $labelText, ['for' => $fieldName]);

        // Générer les options du select
        $selectOptions = '';
        if (isset($options['empty'])) {
            $selectOptions .= $this->Html->tag('option', $options['empty'], ['value' => '']);
        }

        if (isset($options['options'])) {
            foreach ($options['options'] as $value => $text) {
                $selectOptions .= $this->Html->tag('option', $text, ['value' => $value]);
            }
        }

        // Générer le select HTML avec multiple
        $select = $this->Html->tag('select', $selectOptions, [
            'name' => $fieldName . '[]',
            'id' => $fieldName,
            'class' => 'custom-select',
            'multiple' => 'multiple'
        ]);

        return $this->Html->tag(
            'div',
            $label .
            $this->Html->tag(
                'div',
                $this->Html->tag(
                    'div',
                    $this->Html->tag(
                        'span',
                        $this->Html->tag('i', '', ['class' => $icon]),
                        ['class' => 'input-group-text']
                    ),
                    ['class' => 'input-group-prepend']
                ) .
                $select,
                ['class' => 'input-group']
            ),
            ['class' => 'form-group']
        );
    }

    /**
     * Case à cocher
     */
    public function checkboxInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'type' => 'checkbox',
            'class' => 'form-check-input',
            'div' => false,
            'label' => false
        ];

        $options = array_merge($defaultOptions, $options);
        $labelText = $options['label']['text'] ?? $fieldName;

        $input = $this->Form->input($fieldName, $options);
        $label = $this->Html->tag('label', $labelText, [
            'class' => 'form-check-label',
            'for' => $fieldName
        ]);

        return $this->Html->tag(
            'div',
            $input . $label,
            ['class' => 'form-check']
        );
    }

    /**
     * Bouton radio
     */
    public function radioInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'type' => 'radio',
            'class' => 'form-check-input',
            'div' => false,
            'label' => false
        ];

        $options = array_merge($defaultOptions, $options);
        $labelText = $options['label']['text'] ?? ucfirst($fieldName);
        $value = $options['value'] ?? '';
        $name = $options['name'] ?? $fieldName;
        $checked = $options['checked'] ?? false;

        $radioId = $fieldName . '_' . $value . '_' . uniqid();

        $input = $this->Html->tag('input', '', [
            'type' => 'radio',
            'name' => $name,
            'value' => $value,
            'id' => $radioId,
            'class' => 'form-check-input'
        ]);

        $label = $this->Html->tag('label', $labelText, [
            'class' => 'form-check-label',
            'for' => $radioId
        ]);

        return $this->Html->tag(
            'div',
            $input . $label,
            ['class' => 'form-check']
        );
    }

    /**
     * Bouton de soumission
     */
    public function submitButton(string $text = 'Envoyer', array $options = []): string
    {
        $defaultOptions = [
            'class' => 'btn btn-primary',
            'type' => 'submit'
        ];

        $options = array_merge($defaultOptions, $options);
        return $this->Form->button($text, $options);
    }

    /**
     * Bouton de réinitialisation
     */
    public function resetButton(string $text = 'Réinitialiser', array $options = []): string
    {
        $defaultOptions = [
            'class' => 'btn btn-secondary',
            'type' => 'reset'
        ];

        $options = array_merge($defaultOptions, $options);
        return $this->Form->button($text, $options);
    }

    /**
     * Switch personnalisé (toggle)
     */
    public function switchInput(string $fieldName, array $options = []): string
    {
        $defaultOptions = [
            'type' => 'checkbox',
            'class' => 'custom-control-input',
            'div' => false,
            'label' => false
        ];

        $options = array_merge($defaultOptions, $options);
        $labelText = $options['label']['text'] ?? ucfirst($fieldName);
        $value = $options['value'] ?? '1';
        $checked = $options['checked'] ?? false;

        $switchId = $fieldName . '_' . uniqid();

        $input = $this->Html->tag('input', '', [
            'type' => 'checkbox',
            'name' => $fieldName,
            'value' => $value,
            'id' => $switchId,
            'class' => 'custom-control-input',
            'checked' => $checked
        ]);

        $label = $this->Html->tag('label', $labelText, [
            'class' => 'custom-control-label',
            'for' => $switchId
        ]);

        return $this->Html->tag(
            'div',
            $this->Html->tag(
                'div',
                $input . $label,
                ['class' => 'custom-control custom-switch']
            ),
            ['class' => 'form-group']
        );
    }
}
