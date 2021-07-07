<?php

class API
{
  private static $_treeData = [
    [
      "id" => 1,
      "name" => 'My Tree',
      "price" => 777,
      "children" => [
        [
          "id" => 2,
          "name" => 'hello',
          "price" => 777,
        ],
        [
          "id" => 3,
          "name" => 'wat',
          "price" => 777,
        ],
        [
          "id" => 4,
          "name" => 'child folder',
          "price" => 777,
          "children" => [
            [
              "id" => 5,
              "name" => 'child folder',
              "price" => 777,
              "children" => [
                [
                  "id" => 6,
                  "name" => 'hello',
                  "price" => 777,
                ],
                [
                  "id" => 7,
                  "name" => 'wat',
                  "price" => 777,
                ],
              ],
            ],
            [
              "id" => 8,
              "name" => 'hello',
              "price" => 777,
            ],
            [
              "id" => 9,
              "name" => 'wat',
              "price" => 777,
            ],
            [
              "id" => 10,
              "name" => 'child folder',
              "price" => 777,
              "children" => [
                [
                  "id" => 11,
                  "name" => 'hello',
                  "price" => 777,
                ],
                [
                  "id" => 12,
                  "name" => 'wat',
                  "price" => 777,
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
    ],
  ];

  private static function _sendHeaders()
  {
    // for dev webpack server
    // header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Origin: http://skylogik.test/');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400');
  }

  private static function _sendBody($data)
  {
    echo json_encode($data);
  }

  public static function send($data = null)
  {
    if (is_null($data)) {
      $result = self::$_treeData;
    } else {
      $result = $data;
    }

    self::_sendHeaders();
    self::_sendBody($result);
  }
}
