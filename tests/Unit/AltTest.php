<?php

use BeastBytes\Mermaid\ZenumlDiagram\Alt;
use BeastBytes\Mermaid\ZenumlDiagram\Block;
use BeastBytes\Mermaid\ZenumlDiagram\ConditionalBlock;

defined('COMMENT') or define('COMMENT', 'comment');

test('Alt', function () {
    expect((new Alt(new ConditionalBlock('i > 10'), new Block()))
        ->render('')
    )
        ->toBe("if (i > 10) {\n} else {\n}");
});

test('Alt with ElseIf', function () {
    expect((new Alt(new ConditionalBlock('i > 10'), new Block()))
        ->withElseIf(new ConditionalBlock('i < 0'))
        ->render('')
    )
        ->toBe("if (i > 10) {\n} else if (i < 0) {\n} else {\n}");
});

test('Alt with multiple ElseIf', function () {
    expect((new Alt(new ConditionalBlock('i > 10'), new Block()))
        ->withElseIf(
            new ConditionalBlock('i == 0'),
            new ConditionalBlock('i < 0')
        )
        ->render('')
    )
        ->toBe("if (i > 10) {\n} else if (i == 0) {\n} else if (i < 0) {\n} else {\n}");
});

test('With comment', function () {
    expect((new Alt(new ConditionalBlock('i > 10'), new Block()))
        ->withComment(COMMENT)
        ->render('')
    )
        ->toBe('// ' . COMMENT . "\nif (i > 10) {\n} else {\n}");
});

