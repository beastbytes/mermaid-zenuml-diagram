<?php

use BeastBytes\Mermaid\ZenumlDiagram\AsyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\SyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

defined('MESSAGE') or define('MESSAGE', 'message');
defined('METHOD') or define('METHOD', 'method');

test('Sync Message', function () {
    expect(
        (new SyncMessage(
            METHOD,
            new Participant('A'),
            new Participant('B')
        ))
            ->render('')
    )
        ->toBe('A -> B.' . METHOD . '()')
        ->and(
            (new SyncMessage(
                METHOD,
                new Participant('A')
            ))
                ->render('')
        )
        ->toBe('A.' . METHOD . '()')
    ;
});

test('Sync Message with parameters', function () {
    expect(
        (new SyncMessage(
            METHOD,
            new Participant('A'),
            new Participant('B')
        ))
            ->withParameter('p1')
            ->render('')
    )
        ->toBe('A -> B.' . METHOD . '(p1)')
        ->and(
            (new SyncMessage(
                METHOD,
                new Participant('A'),
                new Participant('B')
            ))
                ->withParameter('p1', 'p2')
                ->render('')
        )
        ->toBe('A -> B.' . METHOD . '(p1, p2)')
        ->and(
            (new SyncMessage(
                METHOD,
                new Participant('A')
            ))
                ->withParameter('p1')
                ->render('')
        )
        ->toBe('A.' . METHOD . '(p1)')
        ->and(
            (new SyncMessage(
                METHOD,
                new Participant('A')
            ))
                ->withParameter('p1', 'p2')
                ->render('')
        )
        ->toBe('A.' . METHOD . '(p1, p2)')
    ;
});


test('Sync Message with items', function () {
    expect(
        (new SyncMessage(
            METHOD,
            new Participant('A')
        ))
            ->withItem(
                new AsyncMessage(MESSAGE, new Participant('B'))
            )
            ->render('')
    )
        ->toBe('A.' . METHOD . "() {\n  B: " . MESSAGE . "\n}")
        ->and(
            (new SyncMessage(
                METHOD,
                new Participant('A')
            ))
                ->withParameter('p1')
                ->withItem(
                    new AsyncMessage(MESSAGE, new Participant('B'))

                )
                ->render('')
        )
            ->toBe('A.' . METHOD . "(p1) {\n  B: " . MESSAGE . "\n}")
    ;
});


test('Sync Message with return value', function () {
    expect(
        (new SyncMessage(
            METHOD,
            new Participant('A')
        ))
            ->withReturn(
                'a'
            )
            ->render('')
    )
        ->toBe('a = A.' . METHOD . '()')
        ->and(
            (new SyncMessage(
                METHOD,
                new Participant('A')
            ))
                ->withReturn(
                    'a',
                    'string'
                )
                ->render('')
        )
        ->toBe('string a = A.' . METHOD . '()')
    ;
});
