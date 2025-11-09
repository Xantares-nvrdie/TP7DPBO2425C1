# TP7DPBO2425C1
TUGAS PRAKTIKUM 7 DPBO OOP PHP
Bintang Fajar Putra Pamungkas (2405073)
Ilmu Komputer C1 Universitas Pendidikan Indonesia

## JANJI
Saya Bintang Fajar Putra Pamungkas mengerjakan evaluasi Tugas Praktikum 7 dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# 💻 Katalog Elektronik (PHP Native OOP)
Sebuah aplikasi web sederhana yang dibuat menggunakan PHP Native dengan menerapkan konsep **Object-Oriented Programming (OOP)** secara murni. Proyek ini bertujuan untuk mendemonstrasikan alur kerja **Model-View-Controller (MVC)** sederhana, penggunaan **PDO (PHP Data Objects)**, dan **Prepared Statements** untuk keamanan.
Aplikasi ini mengelola katalog produk elektronik, yang terbagi menjadi tiga entitas utama: Produk, Kategori, dan Brand. Tampilan (UI) dibuat modern dan responsif menggunakan **Tailwind CSS** dengan tema gelap yang elegan.

## ✨ Fitur Utama
* **Manajemen Kategori:** CRUD (Create, Read, Update, Delete) untuk data Kategori.
* **Manajemen Brand:** CRUD (Create, Read, Update, Delete) untuk data Brand.
* **Manajemen Produk:** CRUD (Create, Read, Update, Delete) untuk data Produk.
* **Relasi Database:** Entitas Produk terhubung dengan Kategori dan Brand (relasi *Foreign Key*).
* **Validasi Server-Side:** Mencegah input kosong atau data tidak valid sebelum dikirim ke database.
* **Tampilan Dinamis:** Animasi mengetik dan Lottie di halaman *dashboard*.
* **Keamanan:** Penggunaan **PDO** dan **Prepared Statements** 100% untuk semua *query* database untuk mencegah SQL Injection.

## 🛠️ Tech Stack
* **Front-End:**
    * HTML
    * Tailwind CSS (dimuat via CDN)
    * JavaScript (untuk animasi Lottie & Typed.js)
* **Back-End:**
    * PHP 8.x (Native)
* **Database:**
    * MySQL / MariaDB
    * PDO (PHP Data Objects) untuk koneksi


## 🗄️ Penjelasan Database
Database yang digunakan adalah `db_catalogueElectronics`. Terdiri dari 3 tabel (entitas) yang saling berhubungan:
1.  **`categories`**
    * Tabel ini menyimpan daftar master untuk kategori produk.
    * `name`: Ditetapkan sebagai `UNIQUE` untuk mencegah duplikasi nama kategori.

2.  **`brands`**
    * Tabel ini menyimpan daftar master untuk brand/merek produk.
    * `name`: Ditetapkan sebagai `UNIQUE` untuk mencegah duplikasi nama brand.

3.  **`products`**
    * Tabel ini adalah entitas utama yang menyimpan detail setiap produk.
    * **Relasi:**
        * `category_id`: *Foreign Key* yang terhubung ke `categories(id)`.
        * `brand_id`: *Foreign Key* yang terhubung ke `brands(id)`.
    * **Constraint:** `ON DELETE SET NULL` digunakan agar jika sebuah Kategori atau Brand dihapus, data Produk yang terkait **tidak ikut terhapus**, tetapi *key*-nya akan diatur ke `NULL`.

### Skema SQL
<img width="733" height="303" alt="Screenshot 2025-11-09 at 22 08 14" src="https://github.com/user-attachments/assets/5cf991c5-9ca0-4546-bda7-db7b79a66fd3" />

# 🧩 Alur Aplikasi

## 1. Entry Point
**File:** `index.php`  
**Fungsi:** Main controller yang menangani routing dan logic utama  

**Flow:**
- Start session  
- Include dependencies (database config & classes)  
- Instansiasi semua class (Category, Brand, Product)  
- Handle routing berdasarkan parameter `page` & `action`  
- Process POST requests (save operations)  
- Process GET requests (delete operations)  
- Include appropriate view files  

---

## 2. Database Connection
**File:** `database.php`  
**Class:** `Database`  
**Fungsi:** Mengelola koneksi ke MySQL database menggunakan PDO  

---

## 3. Model Classes

### Category Class
**File:** `Category.php`  
**Methods:**
- `getAllCategory()`: Mengambil semua kategori  
- `addCategory($name)`: Menambah kategori baru  
- `updateCategory($id, $name)`: Update kategori  
- `deleteCategory($id)`: Hapus kategori  
- `readCategory($id)`: Baca kategori by ID  

---

### Brand Class
**File:** `Brand.php`  
**Methods:**
- `getAllBrand()`: Mengambil semua brand  
- `addBrand($name)`: Menambah brand baru  
- `updateBrand($id, $name)`: Update brand  
- `deleteBrand($id)`: Hapus brand  
- `readBrand($id)`: Baca brand by ID  

---

### Product Class
**File:** `Product.php`  
**Methods:**
- `getAllProduct()`: Mengambil semua produk dengan JOIN ke categories & brands  
- `addProduct($name, $category_id, $brand_id, $price, $stock)`: Menambah produk baru  
- `updateProduct($id, $name, $category_id, $brand_id, $price, $stock)`: Update produk  
- `deleteProduct($id)`: Hapus produk  
- `readProduct($id)`: Baca produk by ID


# Demo
## Demo Penggunaan
https://github.com/user-attachments/assets/5f40c790-212b-481a-9816-18ff3484d6a3

## Tampilan database
https://github.com/user-attachments/assets/d710cc1b-666e-4c01-ba5d-bee7d9c4351a



