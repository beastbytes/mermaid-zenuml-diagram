<?php

use BeastBytes\Mermaid\ZenumlDiagram\Par;

test('Par', function () {
    expect((new Par())->render(''))
        ->toBe("par {\n}");
});

