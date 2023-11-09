<?php

declare(strict_types=1);

namespace AutoManager\Form\Fieldset;

use AutoManager\Storage\Entity\Model;
use Laminas\Filter;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Exception\InvalidArgumentException;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator;
use Limatus\Form\Fieldset;
use Limatus\Form\Element;

final class ModelFieldset extends Fieldset implements InputFilterProviderInterface
{
    protected $attributes = [];
    public function __construct($name, $options = [])
    {
        parent::__construct($name, $options);
    }

    /**
     * fields
     * modelId = int, hidden, injected or filtered to null
     * manufacturerId = int, hidden, injected (required)
     * modelName = string,  year
     * @return void
     * @throws InvalidArgumentException
     */
    public function init()
    {
        $this->setObject(new Model());
        $this->setHydrator(new ReflectionHydrator());
        $this->add([
            'name' => 'modelId',
            'type' => Hidden::class,
        ])->add([
            'name' => 'manufacturerId',
            'type' => Hidden::class,
        ])->add([
            'name' => 'modelName',
            'type' => Element\Text::class,
            'help' => 'Full Model Name',
            'options' => [
                'label' => 'Model Name',
                'bootstrap_attributes' => [
                    'class' => 'col-md-5',
                ],
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'modelId',
            'required' => true,
            'continue_if_empty' => true,
        ];
    }
}
