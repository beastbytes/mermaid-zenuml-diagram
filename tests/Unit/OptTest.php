<?php

use BeastBytes\Mermaid\ZenumlDiagram\Opt;

defined('COMMENT') or define('COMMENT', 'comment');

test('Opt', function () {
    expect((new Opt())
        ->render('')
    )
        ->toBe("opt {\n}")
    ;
});

test('Opt with comment', function () {
    expect((new Opt())
        ->withComment(COMMENT)
        ->render('')
    )
        ->toBe('// ' . COMMENT . "\nopt {\n}")
    ;
});
