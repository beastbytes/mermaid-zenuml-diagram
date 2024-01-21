<?php

use BeastBytes\Mermaid\ZenumlDiagram\Opt;

test('Opt', function () {
    expect((new Opt())->render(''))
        ->toBe("opt {\n}");
});
