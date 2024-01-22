<?php

use BeastBytes\Mermaid\ZenumlDiagram\Alt;
use BeastBytes\Mermaid\ZenumlDiagram\Block;
use BeastBytes\Mermaid\ZenumlDiagram\ConditionalBlock;

defined('COMMENT') or define('COMMENT', 'comment');

test('If', function () {
    expect((new Alt(new ConditionalBlock('i > 10')))
        ->render('')
    )
        ->toBe("if (i > 10) {\n}");
});

test('If/Else', function () {
    expect((new Alt(new ConditionalBlock('i > 10')))
        ->withElse(new Block())
        ->render('')
    )
        ->toBe("if (i > 10) {\n} else {\n}");
});

test('If/ElseIf/Else', function () {
    expect((new Alt(new ConditionalBlock('i > 10')))
        ->withElseIf(new ConditionalBlock('i < 0'))
        ->withElse(new Block())
        ->render('')
    )
        ->toBe("if (i > 10) {\n} else if (i < 0) {\n} else {\n}");
});

test('If/ElseIf/ElseIf/Else', function () {
    expect((new Alt(new ConditionalBlock('i > 10')))
        ->withElseIf(
            new ConditionalBlock('i == 0'),
            new ConditionalBlock('i < 0')
        )
        ->withElse(new Block())
        ->render('')
    )
        ->toBe("if (i > 10) {\n} else if (i == 0) {\n} else if (i < 0) {\n} else {\n}");
});

test('With comment', function () {
    expect((new Alt(new ConditionalBlock('i > 10')))
        ->withComment(COMMENT)
        ->render('')
    )
        ->toBe('// ' . COMMENT . "\nif (i > 10) {\n}");
});

