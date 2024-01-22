<?php

use BeastBytes\Mermaid\ZenumlDiagram\Block;
use BeastBytes\Mermaid\ZenumlDiagram\TryCatch;

defined('COMMENT') or define('COMMENT', 'comment');

test('Try/Catch', function () {
    expect((new TryCatch(
        new Block(),
        new Block()
    ))
        ->render('')
    )
        ->toBe("try {\n}\ncatch {\n}");
});

test('Try/Catch/Finally', function () {
    expect((new TryCatch(
        new Block(),
        new Block(),
        new Block()
    ))
        ->render('')
    )
        ->toBe("try {\n}\ncatch {\n}\nfinally {\n}");
});

test('Try/Catch with comment', function () {
    expect((new TryCatch(
        new Block(),
        new Block()
    ))
        ->withComment(COMMENT)
        ->render('')
    )
        ->toBe('// ' . COMMENT . "\ntry {\n}\ncatch {\n}");
});
