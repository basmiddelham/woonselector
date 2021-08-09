<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$button_color = new FieldsBuilder('button_color');
$button_color
    ->addSelect('button_color', ['label' => __('Color', 'strt')])
        ->addChoice('btn-primary', __('Primary', 'strt'))
        ->addChoice('btn-outline-primary', __('Primary outline', 'strt'))
        ->addChoice('btn-secondary', __('Secondary', 'strt'))
        ->addChoice('btn-outline-secondary', __('Secondary outline', 'strt'))
        ->addChoice('btn-light', __('Light', 'strt'))
        ->addChoice('btn-outline-light', __('Light outline', 'strt'))
        ->addChoice('btn-dark', __('Dark', 'strt'))
        ->addChoice('btn-outline-dark', __('Dark outline', 'strt'))
        ->addChoice('btn-info', __('Info', 'strt'))
        ->addChoice('btn-outline-info', __('Info outline', 'strt'))
        ->setDefaultValue('btn-primary');

return $button_color;
