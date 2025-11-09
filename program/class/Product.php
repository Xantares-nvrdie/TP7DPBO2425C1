<?php
class Product {
    private $db;
    private $table_name = "products";

    public function __construct() {
        //cek jika class Database sudah di-load oleh index.php
        if (!class_exists('Database')) {
            require_once 'config/database.php';
        }
        $this->db = (new Database())->conn;
    }

    public function getAllProduct() {
        $query="SELECT 
                p.id, p.name, p.price, p.stock,
                c.name as category_name,
                b.name as brand_name
                FROM " . $this->table_name ." p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                ORDER BY p.id
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function addProduct($name, $category_id, $brand_id, $price, $stock){
        $query="INSERT INTO " . $this->table_name . " 
                    (name, category_id, brand_id, price, stock) 
                    VALUES (?, ?, ?, ?, ?)
                ";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name, $category_id, $brand_id, $price, $stock]);
    }

    public function updateProduct($id, $name, $category_id, $brand_id, $price, $stock){
        $query = "UPDATE " . $this->table_name . " SET 
                    name = ?, 
                    category_id = ?, 
                    brand_id = ?, 
                    price = ?, 
                    stock = ? 
                    WHERE id = ?
                ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $category_id, $brand_id, $price, $stock, $id]);
        return $stmt->rowCount() > 0;
    }

    public function deleteProduct($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function readProduct($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>
