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
    public $sqlStmt; 
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //Function to get SQL stmt
    function getSqlResult()
    {
        return $this->sqlStmt;
    }

    //Function to handle the sql database execution
    // Return: the success of the sql execution
    function executeSql()
    {
        try
        {
            // execute query
            if($this->sqlStmt->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $e)
        {
            return false;
        }
    }
    
    // read products
    function read()
    {
    
        // select all query
        $query = "SELECT
                    p.id, p.name, p.short_description, p.description, p.price, p.rating, p.num_in_stock, p.pic_location
                FROM
                    " . $this->table_name . " p
                ORDER BY
                    p.id DESC";
    

        // prepare query statement
        $this->sqlStmt = $this->conn->prepare($query);

        return $this->executeSql();
    }

    // read products
    function readCategory($cat)
    {
    
        // select all query
        $query = "SELECT
                    p.id, p.name, p.short_description, p.description, p.price, p.rating, p.num_in_stock, p.pic_location, p.cat
                FROM
                    " . $this->table_name . " p
                WHERE  ". $cat ." = p.cat
                ORDER BY
                    p.id DESC";
    

        // prepare query statement
        $this->sqlStmt = $this->conn->prepare($query);

        return $this->executeSql();
        
    }

    // create product
    function create()
    {
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, price=:price, description=:description, category_id=:category_id, created=:created";
    
        // prepare query
        $this->sqlStmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $this->sqlStmt->bindParam(":name", $this->name);
        $this->sqlStmt->bindParam(":price", $this->price);
        $this->sqlStmt->bindParam(":description", $this->description);
        $this->qlStmt->bindParam(":category_id", $this->category_id);
        $this->sqlStmt->bindParam(":created", $this->created);
    
        return $this->executeSql();
        
    }

    // used when filling up the update product form
    function readOne()
    {
    
        // query to read single record
        $query ="SELECT
                    p.id, p.name, p.description, p.price, p.rating, p.num_in_stock, p.pic_location
                FROM
                    " . $this->table_name . " p
                WHERE
                    p.id = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $this->sqlStmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $this->sqlStmt->bindParam(1, $this->id);
    
        if($this->executeSql())
        {
            // get retrieved row
            $row = $sqlStmt->fetch(PDO::FETCH_ASSOC);
        
            // set values to object properties
            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->description = $row['description'];
            $this->rating = $row['rating'];
            $this->name_in_stock = $row['name_in_stock'];
            $this->pic_location = $row['pic_location'];
        }
    }

    function getPics($table_Name)
    {
    // query to read single record
        $query ="SELECT
                    p.id, p.pic_location
                FROM
                    `" . $table_Name . "` p 
                ORDER BY
                    p.id DESC";
    
        // prepare query statement
        $this->sqlStmt = $this->conn->prepare( $query );

        return $this->executeSql();
    }

    // update the product
    function update()
    {
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    price = :price,
                    description = :description,
                    category_id = :category_id
                WHERE
                    id = :id";
    
        // prepare query statement
        $this->sqlStmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $this->sqlStmt->bindParam(':name', $this->name);
        $this->sqlStmt->bindParam(':price', $this->price);
        $this->sqlStmt->bindParam(':description', $this->description);
        $this->sqlStmt->bindParam(':category_id', $this->category_id);
        $this->sqlStmt->bindParam(':id', $this->id);
        
        return $this->executeSql();
    }

    // Get product by ID
    function getById($id)
    {
        if(is_numeric($id))
        {
            // select all query
            $query = "SELECT id, name,short_description,description,price,rating,num_in_stock,cat,pic_location 
            from ". $this->table_name ." where id=".$id;
            
            // prepare query statement
            $this->sqlStmt = $this->conn->prepare($query);
            
            return $this->executeSql();
        }
        else
        {
            return false;
        }
    }

    // search products
    function search($keywords)
    {
    
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
        $this->sqlStmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        // bind
        $this->sqlStmt->bindParam(1, $keywords);
        $this->sqlStmt->bindParam(2, $keywords);
        $this->sqlStmt->bindParam(3, $keywords);
    
        return $this->executeSql();
    }

}
?>
