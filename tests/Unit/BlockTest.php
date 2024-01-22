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
use BeastBytes\Mermaid\ZenumlDiagram\Style;

defined('MESSAGE') or define('MESSAGE', 'message');

test('Block', function () {
    expect((new Block())
        ->withItem(
            new AsyncMessage(
                MESSAGE,
                new Participant('A'),
                new Participant('B')
            )
        )
        ->setType('block')
        ->render('')
    )
        ->toBe("block {\n"
            . '  A -> B: ' . MESSAGE . "\n"
            . '}'
        );
});

test('Block with comments', function() {
    $block = (new Block())->setType('block');

    expect($block
        ->withComment('Comment 1', 'Comment 2')
        ->render('')
    )
        ->toBe("// Comment 1\n"
            . "// Comment 2\n"
            . "block {\n"
            . '}'
        )
        ->and($block
            ->withStyle(Style::Bold, Style::Italic)
            ->render('')
        )
        ->toBe("// [font-bold, italic]\n"
             . "block {\n"
             . '}'
        )
        ->and($block
            ->withStyle(Style::Bold, Style::Italic)
            ->withComment('Comment 1', 'Comment 2')
            ->render('')
        )
        ->toBe("// Comment 1\n"
            . "// Comment 2\n"
            . "// [font-bold, italic]\n"
            . "block {\n"
            . '}'
        )
    ;
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
            ,
            (new Block())
                ->withItem(
                    (new Opt())
                        ->withItem((new CreateMessage(new Participant('Z'))))
                )
            ,
        ))
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
