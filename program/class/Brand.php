<?php
require_once 'config/database.php';

class Brand {
    private $db;
    private $table_name = "brands";

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllBrand() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addBrand($name){
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (?)";
        $stmt = $this->db->prepare($query);
        try {
            return $stmt->execute([$name]);
        } catch (PDOException $e) {
            //kalo nama nya udah ada
            return false;
        }
    }

    public function updateBrand($id, $name){
        $query = "UPDATE " . $this->table_name . " SET name = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $id]);
        //rowCount() mengembalikan jumlah baris yang terpengaruh
        return $stmt->rowCount() > 0;
    }

    public function deleteBrand($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        //rowCount() mengembalikan jumlah baris yang terpengaruh
        return $stmt->rowCount() > 0;
    }

    public function readBrand($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}


?>
