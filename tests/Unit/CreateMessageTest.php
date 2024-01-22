<?php

use BeastBytes\Mermaid\ZenumlDiagram\AsyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\CreateMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

defined('COMMENT') or define('COMMENT', 'comment');
defined('MESSAGE') or define('MESSAGE', 'message');

test('Create Message', function () {
    expect(
        (new CreateMessage(
            new Participant('A')
        ))
            ->render('')
    )
        ->toBe('new A()')
    ;
});

test('Create Message with parameters', function () {
    expect(
        (new CreateMessage(
            new Participant('A')
        ))
            ->withParameter('p1')
            ->render('')
    )
        ->toBe('new A(p1)')
        ->and(
            (new CreateMessage(
                new Participant('A')
            ))
                ->withParameter('p1', 'p2')
                ->render('')
        )
        ->toBe('new A(p1, p2)')
    ;
});


test('Create Message with items', function () {
    expect(
        (new CreateMessage(
            new Participant('A')
        ))
            ->withItem(
                new AsyncMessage(MESSAGE, new Participant('B'))

            )
            ->render('')
    )
        ->toBe("new A() {\n  B: " . MESSAGE . "\n}")
        ->and(
            (new CreateMessage(
                new Participant('A')
            ))
                ->withParameter('p1')
                ->withItem(
                    new AsyncMessage(MESSAGE, new Participant('B'))
                )
                ->render('')
        )
            ->toBe("new A(p1) {\n  B: " . MESSAGE . "\n}")
    ;
});

test('Create Message with comment', function () {
    expect(
        (new CreateMessage(
            new Participant('A')
        ))
            ->withComment(COMMENT)
            ->render('')
    )
        ->toBe('// ' . COMMENT . "\nnew A()")
    ;
});
