<?php


namespace App\Traits\Fixtures;


trait CountryTrait
{
    private $countries = [
        1 => [
            'name' => 'UKRAINE',
            'nicename' => 'Ukraine',
            'iso' => 'UA',
            'phonecode' => '380',
        ],
        2 => [
            'name' => 'POLAND',
            'nicename' => 'Poland',
            'iso' => 'PL',
            'phonecode' => '48',
        ],
    ];
}