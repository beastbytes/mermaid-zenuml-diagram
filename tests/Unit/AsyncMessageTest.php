<?php

use BeastBytes\Mermaid\ZenumlDiagram\AsyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

defined('MESSAGE') or define('MESSAGE', 'message');

test('Async Message', function () {
    expect(
        (new AsyncMessage(
            MESSAGE,
            new Participant('A', 'Alice'),
            new Participant('B')
        ))
            ->render('')
    )
        ->toBe('A -> B: ' . MESSAGE)
    ;
});


test('Async Message with recipient only', function () {
    expect(
        (new AsyncMessage(
            MESSAGE,
            new Participant('A', 'Alice')
        ))
            ->render('')
    )
        ->toBe('A: ' . MESSAGE)
    ;
});
