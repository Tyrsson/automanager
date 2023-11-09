<?php

declare(strict_types=1);

namespace AutoManager\Form\Fieldset;

use AutoManager\Storage\Entity\Manufacturer;
use Laminas\Filter;
use Laminas\Form\Element\Hidden;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator;
use Limatus\Form\Fieldset;
use Limatus\Form\Element;

final class ManufacturerFieldset extends Fieldset implements InputFilterProviderInterface
{
    protected $attributes = ['class' => 'row g-3'];
    public function __construct($name, $options = [])
    {
        parent::__construct($name = 'manufacturer', $options);
    }

    /**
     * columns manufacturerId, manufacturerName, country
     * @return void
     * @throws DomainException
     * @throws InvalidArgumentException
     */
    public function init()
    {
        // the following two method calls is what allows us to get an object instance when calling getData()
        $this->setObject(new Manufacturer());
        $this->setHydrator(new ReflectionHydrator());
        $this->add([
            'name' => 'manufacturerId',
            'type' => Hidden::class,
        ])->add([ // TODO add NoRecordExist Validator to this element
            'name' => 'manufacturerName',
            'type' => Element\Text::class,
            'attributes' => [
                'class'            => 'form-control',
                'placeholder'      => 'Manufacturer',
                'aria-describedby' => 'manufacturerNameHelp',
            ],
            'options' => [
                'label'                => 'Manufacturer',
                'help'                 => 'Full Manufacturer Company Name',
                'bootstrap_attributes' => [
                    'class' => 'col-md-5',
                ],
                'help_attributes' => [
                    'class' => 'form-text text-muted',
                ],
            ],
        ])->add([
            'name' => 'country',
            'type' => Element\Text::class,
            'attributes' => [
                'class'            => 'form-control country',
                'placeholder'      => 'Country',
                'aria-describedby' => 'countryHelp',
            ],
            'options' => [
                'label'                => 'Country',
                'help'                 => 'Full Country Name or abbreviation',
                'bootstrap_attributes' => [
                    'class' => 'col-md-5',
                ],
                'help_attributes'      => [
                    'class' => 'form-text text-muted',
                ],
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'manufacturerId' => [
                'required' => false,
                'filters'  => [
                    ['name' => Filter\ToNull::class],
                    ['name' => Filter\ToInt::class],
                ],
            ],
            'manufacturerName' => [
                'required' => true,
                'filters'  => [
                    ['name' => Filter\StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => Validator\StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],
            'country' => [
                'required' => true,
                'filters'  => [
                    ['name' => Filter\UpperCaseWords::class],
                ],
                'validators' => [
                    [
                        'name'    => Validator\StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],
        ];
    }
}
