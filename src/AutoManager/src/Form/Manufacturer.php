<?php

declare(strict_types=1);

namespace AutoManager\Form;

use AutoManager\Form\Fieldset\ManufacturerFieldset;
use Laminas\Form\Element\Submit;
use Limatus\Form\Form;

final class Manufacturer extends Form
{
    protected $attributes = ['class' => 'row g-3 manufacturer-form', 'method' => 'POST'];
    public function __construct(
        $name = 'manufacturer-form',
        $options = ['mode' => self::DEFAULT_MODE] // Limatus relevant
    ) {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->add([
            'name' => 'manufacturer',
            'type' => ManufacturerFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
            ],
        ])->add([
            'name'       => 'save',
            'type'       => Submit::class,
            'attributes' => [
                'class' => 'col-md-1 btn btn-sm btn-secondary',
                'value' => 'Save',
            ],
        ]);
    }
}
