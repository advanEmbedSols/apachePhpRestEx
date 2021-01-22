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

class Pics{
 
    // database connection and table name
    private $conn;
    public $table_name = "";
 
    // object properties
    public $id;
    public $pic_location;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

        // read products
function read(){
 
    // select all query
    $query = "SELECT
                p.id, p.pic_location
            FROM
                " . $this->table_name . " p
            ORDER BY
                p.id DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function createTable($table_name)
{
   //Set the current context table name before being to create the table
   $this->table_name = htmlspecialchars(strip_tags($table_name));

   // query to insert record
   $query = "CREATE TABLE `" . $this->table_name . "` 
            (
               ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
               PIC_LOCATION TEXT NOT NULL 
            ) ";

    // prepare query
    //$stmt = $this->conn->prepare($query);
    //var_dump($query);
    // execute query
    try{
      $this->conn->exec($query);

      return true;
    }
    catch(PDOException $e)
    {
      echo "Cannot create table".$e->getMessage(); 
      return false;
    }


}

// create product
function create($pic_location){
 
    // query to insert record
    $query = "INSERT INTO
                `" . $this->table_name . "`
            SET
                 pic_location=:pic_location";
 
    // prepare query
    $stmt = $this->conn->prepare($query); 
    // sanitize
    $this->pic_location=htmlspecialchars(strip_tags($pic_location));
    var_dump($pic_location);
    // bind values
    $stmt->bindParam(":pic_location", $this->pic_location);
    var_dump($stmt);
    // execute query
    try{
       if($stmt->execute()){
           return true;
       }
    }
    catch(PDOException $exception){ 
            echo "SQL error: " . $exception->getMessage();
        }

 
    return false;
     
}
}
?>
