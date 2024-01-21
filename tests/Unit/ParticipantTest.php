<?php

use BeastBytes\Mermaid\ZenumlDiagram\Annotation;
use BeastBytes\Mermaid\ZenumlDiagram\Participant;

test('Participant', function () {
    $participant = new Participant('A');

    expect($participant->render(''))
        ->toBe('A')
    ;
});

test('Participant with Alias', function () {
    $participant = new Participant('A', 'Alice');

    expect($participant->render(''))
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
    $participant = new Participant('A', stereotype: 'Customer');

    expect($participant->render(''))
        ->toBe('<<Customer>> A')
    ;
});

test('Participant with everything', function () {
    $participant = new Participant('A', 'Alice', Annotation::Actor, 'Customer');

    expect($participant->render(''))
        ->toBe('@Actor <<Customer>> A as Alice')
    ;
});
