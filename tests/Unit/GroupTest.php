<?php

use BeastBytes\Mermaid\ZenumlDiagram\Group;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

defined('COMMENT') or define('COMMENT', 'comment');

test('Group', function () {
    expect(
        (new Group('Participants'))
            ->withParticipant(
                new Participant('A', 'Alice'),
                new Participant('B')
            )
            ->addParticipant(
                new Participant('C', 'Chris'),
                new Participant('D')
            )
            ->render('')
    )
        ->toBe("group Participants {\n  A as Alice\n  B\n  C as Chris\n  D\n}")
    ;
});

test('Group with comment', function () {
    expect(
        (new Group('Participants'))
            ->withComment(COMMENT)
            ->withParticipant(
                new Participant('A', 'Alice'),
                new Participant('B')
            )
            ->addParticipant(
                new Participant('C', 'Chris'),
                new Participant('D')
            )
            ->render('')
    )
        ->toBe('// ' . COMMENT . "\ngroup Participants {\n  A as Alice\n  B\n  C as Chris\n  D\n}")
    ;
});
