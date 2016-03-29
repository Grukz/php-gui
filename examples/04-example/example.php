<?php

require __DIR__ . '/../../vendor/autoload.php';

use Gui\Application;
use Gui\Components\Label;
use Gui\Components\InputText;
use Gui\Components\Button;
use Gui\Components\Shape;
use Gui\Components\Window;

$application = new Application([
    'title' => 'My PHP Desktop Application',
    'left' => 30,
    'top' => 40,
    'width' => 480,
    'height' => 256
]);

$application->on('start', function() use ($application) {

    $label = new Label([
        'text' => 'First Form',
        'top' => 10,
        'left' => 40,
        'fontSize' => 20,
    ]);

    $shape = new Shape([
        'backgroundColor' => '#EEE',
        'borderColor' => '#DDD',
        'left' => 40,
        'top' => 60,
        'width' => 400,
        'height' => 150
    ]);

    $data = [
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'company' => 'Company'
    ];

    $c = 0;
    $form = [];
    foreach ($data as $key => $value) {
        $calculatedTop = ($c++ * 35);

        ${'label_' . $key} = new Label([
            'text' => $value . ':',
            'top' => 72 + $calculatedTop,
            'left' => 45,
            'fontSize' => 10,
        ]);

        ${'edit_' . $key} = new InputText([
            'top' => 65 + $calculatedTop,
            'left' => 110,
            'fontSize' => 25,
            'width' => 320
        ]);

        $form[$value] = ${'edit_' . $key};
    }

    $button = new Button([
        'value' => 'Save',
        'top' => 216,
        'left' => 40,
        'width' => 400
    ]);

    $button->on('click', function () use ($form) {
        $window = new Window([
            'title' => 'Form1 Info',
            'width' => 400,
            'height' => 400,
        ]);

        $c = 0;
        foreach ($form as $key => $value) {
            $calculatedTop = ($c++ * 35);

            ${'label_' . strtolower($key)} = new Label(
                [
                    'text' => $key . ':',
                    'top' => 10 + $calculatedTop,
                    'left' => 30,
                    'fontSize' => 10,
                ],
                $window
            );

            ${strtolower($key)} = new Label(
                [
                    'text' => $value->getValue(),
                    'top' => 10 + $calculatedTop,
                    'left' => 100,
                    'fontSize' => 10,
                ],
                $window
            );
        }
    });
});

$application->run();
