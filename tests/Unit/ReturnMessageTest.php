<?php

use BeastBytes\Mermaid\ZenumlDiagram\AsyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;
use BeastBytes\Mermaid\ZenumlDiagram\ReturnMessage;

defined('COMMENT') or define('COMMENT', 'comment');
defined('RETURN_VALUE') or define('RETURN_VALUE', 'return value');

test('Return Message', function () {
    expect(
        (new ReturnMessage(RETURN_VALUE))
            ->render('')
    )
        ->toBe('return "' . RETURN_VALUE . '"')
    ;
});

test('Return Async Message', function () {
    expect(
        (new ReturnMessage(
            new AsyncMessage(
                RETURN_VALUE,
                new Participant('A'),
                new Participant('B')
            )
        ))
            ->render('')
    )
        ->toBe('@return A -> B: ' . RETURN_VALUE)
    ;
});

test('Return Message with comment', function () {
    expect(
        (new ReturnMessage(RETURN_VALUE))
            ->withComment(COMMENT)
            ->render('')
    )
        ->toBe('// ' . COMMENT . "\nreturn \"" . RETURN_VALUE . '"')
    ;
});
