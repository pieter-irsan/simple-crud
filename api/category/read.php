<?php

//Required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Include database and object files
include_once("../config/databse.php");
include_once("../objects/category.php");

//Instantiate database and product object
$databse = new Database;
$db = $database->getConnection();
$category = new Category($db);

//Query products
$stmt = $category->read();
$num = $stmt->rowCount();

//Check if more than 0 records found
if ($num > 0) {
    
    //Creating products array
    $categories_arr = array();
    $categories_arr['records'] = array();

    //Retrieve our table contents
    //fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //Extract row
        //This will make $row['name'] to just $name only
        extract($row);

        $category_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description)
        );

        array_push($categories_arr["records"], $category_item);
    }
    echo json_encode($categories_arr);
} else {
    echo json_encode(
        array("message"=>"No category found.")
    );
}