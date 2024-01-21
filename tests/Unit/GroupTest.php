<?php

use BeastBytes\Mermaid\ZenumlDiagram\Group;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

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
