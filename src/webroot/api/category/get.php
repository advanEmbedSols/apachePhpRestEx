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

//Only serve a GET request
if( $_SERVER["REQUEST_METHOD"] == "GET")
{

   //Category Number Range
   //The range of valid numbers for categories
   $cat_min_num = 1;
   $cat_max_num = 2;

   include_once '../objects/tools.php';

   //Sanitize the category number
   $cat_num = htmlspecialchars(stripslashes(trim(strip_tags($_GET["cat"]))));
   if(!is_numeric($cat_num))
   {
      //The category number is not correct
      http_response_code(400);
      echo getErorrJsonMessage("Category Number must be an integer");
   }
   else
   {
      //Convert to INT and verify number is in proper range
      $cat_num = (int)$cat_num;
      if(($cat_min_num <= $cat_num) && ($cat_max_num >= $cat_num))
      {
         include_once '../objects/product.php';
         include_once '../config/database.php';

         //Get a connection to the Database
         $db = new Database();

         $conn = $db->getConnection();

         if( $conn != null)
         {

            $product = new Product($conn);

            // query products
            if( $product->readCategory($cat_num))
            {
               //After a success get the result object
               $stmt = $product->getSqlResult();
               $num = $stmt->rowCount();

               if($num > 0 )
               {
                  //Create a new array to hold the records
                  $array_products = Array();
                  $array_products["records"]=array();
                  
                  //Run through all results
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                  {  
                     //Create an entry with all the information
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
                     
                     //If found add the picture locations
                     if($product->getPics($row['pic_location']))
                     {
                        $stmtPics = $product->getSqlResult();
                        //Run through the return results for the pics
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
                     }
                      
                     array_push($array_products["records"], $product_item);
                  }
            
                  // set response code - 200 OK
                  http_response_code(200);
            
                  // show products data in json format
                  echo getSuccessJsonMessage('Done', $array_products);
               }
               else
               {
                  http_response_code(200);
                  echo getSuccessJsonMessage("No products found for category", Array());
               }
            }
            else
            {
               //Resource is not found 
               http_response_code(404);
               echo getErorrJsonMessage("Product Category not found");
            }
         }
         else
         {
            //Database could not be connected 
            http_response_code(500);
            echo getErorrJsonMessage("Site is currently experiencing issues");
         }
      } 
   }
}
else
{
   //Send a 405 response since only GET is allowed
   http_response_code(405);
}
?>
