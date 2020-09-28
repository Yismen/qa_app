<?php

return [
    'index' => [
        'form' => [
            'header' => 'Create a New Audit',
        ],
        'labels' => [
            'forms' => 'Select a Form:',
            'users' => 'Select a User:',
            'button' => 'START AUDIT',
        ]
    ],
    'list' => [
        'header' => 'Audits List',
        'table' => [
            'header' => [
                'date' => 'Date:',
                'user' => 'User:',
                'qa_form' => 'QA Form:',
                'points' => 'Points:',
                'passes' => 'Passes?:',
                'actions' => 'Actions:',
            ],
            'buttons' => [
                'details' => 'Details',
                'edit' => 'Edit',
            ]
        ]
    ],
    'create' => [
        'form' => [
            'header' => 'Complete This Audit',
        ],
        'labels' => [
            'button' => 'SAVE THIS AUDIT',
        ],
    ],
    'edit' => [
        'form' => [
            'header' => 'Edit Audit',
        ],
        'labels' => [
            'button' => 'UPDATE AUDIT',
        ],
    ],
    'show' => [
        'form' => [
            'header' => 'Audit Details',
        ],
        'questions' => [
            'header' => 'Questions Results'
        ],
        'table' => [
            'headers' => [
                'question' => 'Question:',
                'result' => 'Results:',
            ]
        ]
    ],
    'labels' => [
        'all' => 'All',
        'edit' => 'Edit',
        'user' => 'User:',
        'qa_form' => 'QA Form:',
        'production_date' => 'Production Date:',
        'total_points' => 'Total Points Possible:',
        'points_required' => 'Total Points Required to Pass:',
        'points_reached' => 'Total Points Reached:',
        'pass_fail' => 'Passed or Failed:',
    ]
];
