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
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $short_description;
    public $price;
    public $rating;
    public $num_in_stock;
    public $pic_location;
    public $cat;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                p.id, p.name, p.description, p.price, p.rating, p.num_in_stock, p.pic_location, p.cat
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

// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO 
                " . $this->table_name . "
            SET
                name=:name, price=:price, description=:description, short_description=:short_description, rating=:rating, num_in_stock=:num_in_stock, pic_location=:pic_location, cat=:cat";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->short_description=htmlspecialchars(strip_tags($this->short_description));
    $this->rating=htmlspecialchars(strip_tags($this->rating));
    $this->num_in_stock=htmlspecialchars(strip_tags($this->num_in_stock));
    $this->pic_location=htmlspecialchars(strip_tags($this->pic_location));
    $this->cat=htmlspecialchars(strip_tags($this->cat)); 
 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":short_description", $this->short_description);
    $stmt->bindParam(":rating", $this->rating);
    $stmt->bindParam(":num_in_stock", $this->num_in_stock);
    $stmt->bindParam(":pic_location", $this->pic_location);
    $stmt->bindParam(":cat", $this->cat); 
    
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

// used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query ="SELECT
                p.id, p.name, p.description, p.price, p.short_description, p.rating, p.num_in_stock, p.pic_location, p.cat
            FROM
                " . $this->table_name . " p
            WHERE
                p.name =:name
            LIMIT
                0,1";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(":name", $this->name);
 
    // execute query
    $stmt->execute();

    if($stmt->rowCount() > 0)
    { 
         // get retrieved row
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
         // set values to object properties
         $this->id = $row['id'];
         $this->name = $row['name'];
         $this->price = $row['price'];
         $this->description = $row['description'];
         $this->short_description = $row['short_description'];
         $this->rating = $row['rating'];
         $this->num_in_stock = $row['num_in_stock'];
         $this->pic_location = $row['pic_location'];
         $this->cat = $row['cat']; 
         return true;
    }
    else
    {
         return false;
    }
}
// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                id = :id,
                price = :price,
                short_description = :short_description,
                description = :description,
                rating = :rating,
                num_in_stock = :num_in_stock,
                pic_location = :pic_location,
                cat = :cat
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->short_description=htmlspecialchars(strip_tags($this->short_description));
    $this->rating=htmlspecialchars(strip_tags($this->rating));
    $this->num_in_stock=htmlspecialchars(strip_tags($this->num_in_stock));
    $this->pic_location=htmlspecialchars(strip_tags($this->pic_location));
    $this->cat=htmlspecialchars(strip_tags($this->cat)); 
 
    // bind values
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":short_description", $this->short_description);
    $stmt->bindParam(":rating", $this->rating);
    $stmt->bindParam(":num_in_stock", $this->num_in_stock);
    $stmt->bindParam(":pic_location", $this->pic_location);
    $stmt->bindParam(":cat", $this->cat); 
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

function erase()
{
   // select all query
    $query = "DELETE FROM \'" . $this->table_name . "\'
              WHERE \'" . $this->table_name . "\'.\'ID\'=:id";
 
    // prepare query statement
    var_dump($query);
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $this->id);
    var_dump($stmt);
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;

}

/*// search products
function search($keywords){
 
    // select all query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
            ORDER BY
                p.created DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}*/

}
?>
