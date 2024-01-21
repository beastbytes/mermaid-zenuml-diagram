<?php

use BeastBytes\Mermaid\ZenumlDiagram\AsyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;
use BeastBytes\Mermaid\ZenumlDiagram\ReturnMessage;

defined('RETURN_VALUE') or define('RETURN_VALUE', 'return value');

test('Return Message', function () {
    expect(
        (new ReturnMessage(RETURN_VALUE))
            ->render('')
    )
        ->toBe('return "return value"')
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
        ->toBe("@return A -> B: return value")
    ;
});
