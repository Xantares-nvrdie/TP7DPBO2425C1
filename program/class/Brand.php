<?php
require_once 'config/database.php';

class Brand {
    private $db;
    private $table_name = "brands";

    //untuk koneksi database
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    //mengambil semua data brand
    public function getAllBrand() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //menambahkan data brand
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

    //mengupdate data brand
    public function updateBrand($id, $name){
        $query = "UPDATE " . $this->table_name . " SET name = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $id]);
        //rowCount() mengembalikan jumlah baris yang terpengaruh
        return $stmt->rowCount() > 0;
    }

    //menghapus data brand
    public function deleteBrand($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        //rowCount() mengembalikan jumlah baris yang terpengaruh
        return $stmt->rowCount() > 0;
    }

    //mengambil data brand berdasarkan id
    public function readBrand($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}


?>
