<?php

use BeastBytes\Mermaid\ZenumlDiagram\Loop;
use BeastBytes\Mermaid\ZenumlDiagram\LoopType;

test('Loop', function (LoopType $loopType, string $condition, string $result) {
    expect((new Loop($condition, $loopType))->render(''))
        ->toBe($result);
})
    ->with([
        [LoopType::For, 'i=0; i<10; i++', "for (i=0; i<10; i++) {\n}"],
        [LoopType::Foreach, '$groups as $group', "forEach (\$groups as \$group) {\n}"],
        [LoopType::Loop, 'every minute', "loop (\"every minute\") {\n}"],
        [LoopType::Loop, 'hourly', "loop (hourly) {\n}"],
        [LoopType::While, 'the sun is shining', "while (\"the sun is shining\") {\n}"]
    ])
;
