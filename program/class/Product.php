<?php
class Product {
    private $db;
    private $table_name = "products";

    //untuk koneksi database
    public function __construct() {
        //cek jika class Database sudah di-load oleh index.php
        if (!class_exists('Database')) {
            require_once 'config/database.php';
        }
        $this->db = (new Database())->conn;
    }

    //mengambil semua data product dengan join ke category dan brand
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

    //menambahkan data product
    public function addProduct($name, $category_id, $brand_id, $price, $stock){
        $query="INSERT INTO " . $this->table_name . " 
                    (name, category_id, brand_id, price, stock) 
                    VALUES (?, ?, ?, ?, ?)
                ";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name, $category_id, $brand_id, $price, $stock]);
    }

    //mengupdate data product
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

    //menghapus data product
    public function deleteProduct($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    //mengambil data product berdasarkan id
    public function readProduct($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>
