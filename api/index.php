<?php

$treeData = [
  [
    "id" => 1,
    "name" => 'My Tree',
    "price" => 777,
    "isChecked" => false,
    "children" => [
      [
        "id" => 2,
        "name" => 'hello',
        "price" => 777,
        "isChecked" => false,
      ],
      [
        "id" => 3,
        "name" => 'wat',
        "price" => 777,
        "isChecked" => false,
      ],
      [
        "id" => 4,
        "name" => 'child folder',
        "price" => 777,
        "isChecked" => false,
        "children" => [
          [
            "id" => 5,
            "name" => 'child folder',
            "price" => 777,
            "isChecked" => false,
            "children" => [
              [
                "id" => 6,
                "name" => 'hello',
                "price" => 777,
                "isChecked" => false,
              ],
              [
                "id" => 7,
                "name" => 'wat',
                "price" => 777,
                "isChecked" => false,
              ],
            ],
          ],
          [
            "id" => 8,
            "name" => 'hello',
            "price" => 777,
            "isChecked" => false,
          ],
          [
            "id" => 9,
            "name" => 'wat',
            "price" => 777,
            "isChecked" => false,
          ],
          [
            "id" => 10,
            "name" => 'child folder',
            "price" => 777,
            "isChecked" => false,
            "children" => [
              [
                "id" => 11,
                "name" => 'hello',
                "price" => 777,
                "isChecked" => false,
              ],
              [
                "id" => 12,
                "name" => 'wat',
                "price" => 777,
                "isChecked" => false,
              ],
            ],
          ],
        ],
      ],
    ],
  ],
  [
    "id" => 13,
    "name" => 'wat',
    "price" => 777,
    "isChecked" => false,
  ],
];

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');
echo json_encode($treeData);