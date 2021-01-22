<?php
//Copyright 2021 - Kyle Johnson
/* This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
if( $_SERVER["REQUEST_METHOD"] == "POST")
{

include_once '../objects/product.php';
include_once '../config/database.php';
include_once '../objects/pics.php';


$db = new Database();

$conn = $db->getConnection();

if( $conn != null)
{
   $product = new Product($conn);
   $pics = new Pics($conn);
   
   if($product != null)
   {
      $product->name = $_POST["name"];
      $product->description = $_POST["description"];
      $product->short_description = $_POST["short_description"];
      $product->price = $_POST["price"];
      $product->rating = $_POST["rating"];
      $product->num_in_stock = $_POST["num_in_stock"];
      $product->cat = $_POST["cat"];
      
      if($product->create() and $product->readOne())
      {
         $table_name = $product->id."_img";
         var_dump($_POST);
         if($pics->createTable($table_name) and $pics->create($_POST["pic_location"]))
         {
            $product->pic_location = $table_name;
            $product->update();
            http_response_code(200);
         }
         else
         { 
            http_response_code(401);
            echo "Error creating new table";
         }
             
      }
      else
      {
         http_response_code(500);
         echo "Problem adding to database";
      }
   }
   else
   {
      http_response_code(401);
   }
}
else
{
   http_response_code(401);
   echo "Problem Connecting to Database";
}
}
?>
