<?php

include_once "Database.php";

class Product extends Database {

    public function __construct() {
        parent::__construct();
    }

    public function insert_product($input_data) {
        try {
            $sql = "
                INSERT INTO products 
                    (product_name, product_description, product_price) 
                        VALUES (:pname, :pdesc, :pprice);
            ";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':pname', $input_data['p_name']);
            $stmt->bindParam(':pdesc', $input_data['p_desc']);
            $stmt->bindParam(':pprice', $input_data['p_price']);

            $stmt->execute();

            return "Successfully inserted..";
        }
        catch(PDOException $e) {
            return "Something went wrong.. Case: $e";
        }

    }

    public function load_all_products() {
        try {

            $sql = "SELECT * FROM products ORDER BY product_posted DESC";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $products;
            
        }catch(PDOException $e) {
            return $e;
        }
    }

    public function remove_product($id) {

        try {
            
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return "Successfully deleted..";

        }catch(PDOException $e) {
            return "Error deleting.. Cause: $e";
        }

    }

    public function load_product($id) {

        try {
            
            $sql = "SELECT * FROM products WHERE id = :id";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            return $product;
        } catch(PDOException $e) {
            return "Something went wrong. Cause: $e";
        }
        
    }

    
    public function update_product($formbody) {

        try {

            $sql = "UPDATE products 
                    SET product_name = :p_name, 
                    product_description = :p_desc,
                    product_price = :p_price
                    WHERE id = :p_id;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':p_name', $formbody['p_name']);
            $stmt->bindParam(':p_desc', $formbody['p_desc']);
            $stmt->bindParam(':p_price', $formbody['p_price']);
            $stmt->bindParam(':p_id', $formbody['p_id']);
            $stmt->execute();

            return "Updated succesfully";
        } catch(PDOException $e) {
            return "Something went wrong. Cause: $e";
        }

    }

}