<?php

return [
    // If true, the breadcrumbs list will be wrapped inside a <div> tag
    'wrapper' => false,
    'wrapper-class' => '__nova_breadcrumbs',

    // Defines which tag will be the list element
    'list-element' => 'ol',
    'list-class' => 'nav-wrapper',

    // Defines which tag will be the item element
    'item-element' => 'li',
    'breadcrumb' => [
        // The class that every element will share
        'common' => 'breadcrumb',

        // The class assigned to the first element of the list
        'first' => '',

        // The class assigned to every element, except the last one
        'before-last' => 'grey-text',

        // The class assigned to the last element exclusively
        'last' => 'cyan-text',
    ],
    
    // Works like 'breadcrumbs' entry
    'anchor' => [
        'common' => '',
        'first' => '',
        'before-last' => 'grey-text',
        'last' => 'cyan-text',
    ]
];
