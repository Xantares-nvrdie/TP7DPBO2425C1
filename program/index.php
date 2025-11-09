<?php
session_start();
require_once 'config/database.php';
require_once 'class/Category.php';
require_once 'class/Brand.php';
require_once 'class/Product.php';

// INSTANSIASI SEMUA CLASS
try {
    $category = new Category();
    $brand = new Brand();
    $product = new Product();
} catch (PDOException $e) {
    die("GAGAL MEMBUAT KONEKSI AWAL: " . $e->getMessage());
}

// routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// logic
$redirectUrl = null;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($action === 'save') {
            switch ($page) {
                //jika memilih opsi list kategori
                case 'categories':
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    if (empty($name)) {
                        $_SESSION['error_message'] = "Nama Kategori tidak boleh kosong.";
                        $redirectUrl = "index.php?page=categories&action=form" . ($id ? "&id=$id" : "");
                    } else {
                        if ($id) { $category->updateCategory($id, $name); } 
                        else { $category->addCategory($name); }
                        $redirectUrl = "index.php?page=categories";
                    }
                    break;
                //jika memilih opsi list brand
                case 'brands':
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    if (empty($name)) {
                        $_SESSION['error_message'] = "Nama Brand tidak boleh kosong.";
                        $redirectUrl = "index.php?page=brands&action=form" . ($id ? "&id=$id" : "");
                    } else {
                        if ($id) { $brand->updateBrand($id, $name); } 
                        else { $brand->addBrand($name); }
                        $redirectUrl = "index.php?page=brands";
                    }
                    break;
                //jika memilih opsi list produk
                case 'products':
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $category_id = $_POST['category_id'];
                    $brand_id = $_POST['brand_id'];
                    $price = $_POST['price'];
                    $stock = $_POST['stock'];
                    // Validasi (Mencegah 'cannot be null')
                    if (empty($name) || empty($category_id) || empty($brand_id) || (!isset($price) || $price === '') || (!isset($stock) || $stock === '')) {
                        $_SESSION['error_message'] = "Gagal menyimpan! Semua field (termasuk Harga dan Stok) wajib diisi.";
                        $formUrl = "index.php?page=products&action=form";
                        if ($id) { $formUrl .= "&id=$id"; }
                        $redirectUrl = $formUrl;
                    } else {
                        // Jika lolos validasi, kirim SEMUA parameter
                        if ($id) {
                            $product->updateProduct($id, $name, $category_id, $brand_id, $price, $stock);
                        } else {
                            $product->addProduct($name, $category_id, $brand_id, $price, $stock);
                        }
                        $redirectUrl = "index.php?page=products";
                    }
                    break;
            }
        }
    } 
    // Logika untuk 'delete' (dari request GET)
    else if ($action === 'delete' && $id) {
        switch ($page) {
            case 'categories':
                $category->deleteCategory($id);
                $redirectUrl = "index.php?page=categories";
                break;
            case 'brands':
                $brand->deleteBrand($id);
                $redirectUrl = "index.php?page=brands";
                break;
            case 'products':
                $product->deleteProduct($id);
                $redirectUrl = "index.php?page=products";
                break;
        }
    }
    // Lakukan redirect jika ada
    if ($redirectUrl) {
        header("Location: " . $redirectUrl);
        exit;
    }
} catch (PDOException $e) {
    // Tangani error database
    $_SESSION['error_message'] = "Error Database: " . $e->getMessage();
    $fallbackUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php?page=home';
    header("Location: " . $fallbackUrl);
    exit;
}

include_once 'views/ui/header.php';
// Switch utama untuk menentukan file view mana yang akan di-include
switch ($page) {
    // Halaman Kategori
    case 'categories':
        if ($action === 'list') {
            $categories = $category->getAllCategory();
            include 'views/categories/list.php';
        } elseif ($action === 'form') {
            $data = null;
            if ($id) {
                $data = $category->readCategory($id);
            }
            include 'views/categories/form.php';
        }
        break;
    // Halaman Brand
    case 'brands':
        if ($action === 'list') {
            $brands = $brand->getAllBrand();
            include 'views/brands/list.php';
        } elseif ($action === 'form') {
            $data = null;
            if ($id) {
                $data = $brand->readBrand($id); // PERBAIKAN: readOne -> readBrand
            }
            include 'views/brands/form.php';
        }
        break;
    // Halaman Produk
    case 'products':
        if ($action === 'list') {
            $products = $product->getAllProduct();
            include 'views/products/list.php';
        } elseif ($action === 'form') {
            $data = null;
            if ($id) {
                $data = $product->readProduct($id); // PERBAIKAN: readOne -> readProduct
            }
            // Form produk butuh data Kategori dan Brand untuk dropdown
            $categories = $category->getAllCategory();
            $brands = $brand->getAllBrand();
            include 'views/products/form.php';
        }
        break;
    // Halaman Home (default)
    case 'home':
    default:
        include 'views/home.php';
        break;
}

// Memuat footer (sesuai path baru 'views/ui/')
include_once 'views/ui/footer.php';

?>
