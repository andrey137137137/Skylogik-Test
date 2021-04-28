<?php
require_once "class.php";

$_REQUEST = json_decode(file_get_contents('php://input'), true);

if (isset($_REQUEST['selectedProducts']) && isset($_REQUEST['totalPrice'])) {
  API::send('Products ' . $_REQUEST['selectedProducts'] . 'added to data base with total price: ' . $_REQUEST['totalPrice']);
} else {
  API::send('ERROR');
}
