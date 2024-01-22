<?php

use BeastBytes\Mermaid\ZenumlDiagram\Par;

defined('COMMENT') or define('COMMENT', 'comment');

test('Par', function () {
    expect((new Par())
        ->render('')
    )
        ->toBe("par {\n}")
    ;
});

test('Par with comment', function () {
    expect((new Par())
        ->withComment(COMMENT)
        ->render('')
    )
        ->toBe('// ' . COMMENT . "\npar {\n}")
    ;
});

