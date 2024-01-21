<?php

use BeastBytes\Mermaid\ZenumlDiagram\Block;
use BeastBytes\Mermaid\ZenumlDiagram\TryCatch;

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
