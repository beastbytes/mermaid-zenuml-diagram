<?php

use BeastBytes\Mermaid\ZenumlDiagram\Annotation;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

defined('COMMENT') or define('COMMENT', 'comment');

test('Participant', function () {
    expect((new Participant('A'))
        ->render('')
    )
        ->toBe('A')
    ;
});

test('Participant with Alias', function () {
    expect((new Participant('A', 'Alice'))
        ->render('')
    )
        ->toBe('A as Alice')
    ;
});

test('Participant with Annotation', function () {
    $participant = new Participant('A', annotation: Annotation::Actor);

    expect($participant->render(''))
        ->toBe('@Actor A')
    ;
});

test('Participant with stereotype', function () {
    expect((new Participant('A', stereotype: 'Customer'))
        ->render('')
    )
        ->toBe('<<Customer>> A')
    ;
});

test('Participant with everything', function () {
    expect((new Participant('A', 'Alice', Annotation::Actor, 'Customer'))
        ->render('')
    )
        ->toBe('@Actor <<Customer>> A as Alice')
    ;
});
test('Participant with comment', function () {
    expect((new Participant('A'))
        ->withComment(COMMENT)
        ->render('')
    )
        ->toBe('// ' . COMMENT . "\nA")
    ;
});
