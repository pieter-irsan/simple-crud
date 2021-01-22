<?php

//Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

date_default_timezone_set("Asia/Kolkata");

//Get database connection and product object
include_once("../config/database.php");
include_once("../objects/product.php");

//Instantiate new objects
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

//Get posted data
$data = json_decode(file_get_contents("php://input"));

//Set product property values
$product->name = $data->name;
$product->description = $data->description;
$product->price = $data->price;
$product->category_id = $data->category_id;
$product->created = date('Y-m-d H:i:s');

//Let's create product now
if ($product->create()) {
    echo json_encode(
        array("message" => "Product was created.")
    );
} else {    //If unable to create product, notify user
    echo json_encode(
        array("message" => "Unable to create product.")
    );
}