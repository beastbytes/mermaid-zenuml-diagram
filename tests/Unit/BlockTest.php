<?php

use BeastBytes\Mermaid\ZenumlDiagram\Alt;
use BeastBytes\Mermaid\ZenumlDiagram\AsyncMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Block;
use BeastBytes\Mermaid\ZenumlDiagram\ConditionalBlock;
use BeastBytes\Mermaid\ZenumlDiagram\CreateMessage;
use BeastBytes\Mermaid\ZenumlDiagram\Loop;
use BeastBytes\Mermaid\ZenumlDiagram\LoopType;
use BeastBytes\Mermaid\ZenumlDiagram\Opt;
use BeastBytes\Mermaid\ZenumlDiagram\Par;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

defined('MESSAGE') or define('MESSAGE', 'message');

test('Block', function () {
    $output = [];

    (new Block())
        ->withItem(
            new AsyncMessage(
                MESSAGE,
                new Participant('A'),
                new Participant('B')
            )
        )
        ->renderBlock('block', '', $output)
    ;

    expect($output)
        ->toBe([
            'block {',
            '  A -> B: ' . MESSAGE,
            '}'
        ]);
});

test('Nested Blocks', function() {
    expect(
        (new Alt(
            (new ConditionalBlock('i > 0'))
                ->withItem(
                    (new Loop('i>0', LoopType::While))
                        ->withItem(
                            (new Par())
                                ->withItem(
                                    new AsyncMessage(
                                        MESSAGE,
                                        new Participant('A'),
                                        new Participant('B')
                                    ),
                                    new AsyncMessage(
                                        MESSAGE,
                                        new Participant('C'),
                                        new Participant('D')
                                    )
                                )
                        )
                )
        ))
            ->withElse(
                (new Block())
                    ->withItem(
                        (new Opt())
                            ->withItem((new CreateMessage(new Participant('Z'))))
                    )
            )
            ->render('')
    )
        ->toBe("if (i > 0) {\n"
               . "  while (i>0) {\n"
               . "    par {\n"
               . '      A -> B: ' . MESSAGE . "\n"
               . '      C -> D: ' . MESSAGE . "\n"
               . "    }\n"
               . "  }\n"
               . "} else {\n"
               . "  opt {\n"
               . "    new Z()\n"
               . "  }\n"
               . '}'
        )
    ;
});
