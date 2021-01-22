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
include_once '../objects/product.php';
include_once '../config/database.php';

$db = new Database();

$conn = $db->getConnection();

if( $conn != null)
{

   $product = new Product($conn);

   // query products
   $stmt = $product->read();
   $num = $stmt->rowCount();

   if($num > 0 )
   {
      $array_products = Array();
      $array_products["records"]=array();
      //var_dump($stmt); 
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {  
         $product_item=array(
            "id" => $row['id'],
            "name" => $row['name'],
            "description" => html_entity_decode($row['description']),
            "short_description" => html_entity_decode($row['short_description']),
            "price" => $row['price'],
            "rating" => $row['rating'],
            "num_in_stock" => $row['num_in_stock'],
            "pics" => array()
         );

         $stmtPics = $product->getPics($row['pic_location']);
         if( $stmtPics->rowCount() > 0 )
         {
            while ($picRow = $stmtPics->fetch(PDO::FETCH_ASSOC))
            {
               $pic_item=array(
                  "id" => $picRow['id'],
                  "pic_location" => $picRow['pic_location']
               );
               array_push($product_item["pics"], $pic_item);
            }

         }
 
         array_push($array_products["records"], $product_item);
      }
 
      // set response code - 200 OK
      http_response_code(200);
 
      // show products data in json format
      echo json_encode($array_products);
   }
   else
   {
      http_response_code(401);
      echo "Product Not Found";
   }
}
else
{
   http_response_code(401);
   echo "Site is currently experiencing issues";
}
?>
