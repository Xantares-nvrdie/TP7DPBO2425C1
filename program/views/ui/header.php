<?php
// Ambil variabel $page yang sudah didefinisikan di index.php
$currentPage = $page ?? 'home';

// Helper function untuk kelas 'active' Tailwind
function getActiveClass($pageName, $currentPage) {
    if ($pageName == $currentPage) {
        // Kelas untuk link aktif (Biru)
        return 'bg-blue-600 text-white';
    } else {
        // Kelas untuk link non-aktif (Dark)
        return 'text-slate-300 hover:bg-slate-800 hover:text-slate-100';
    }
}
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Elektronik Terlengkap se-MilkyWay</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
    tailwind.config = {
    theme: {
        extend: {
            colors: {
                'slate': {
                950: '#0b1120', // Latar belakang utama
                900: '#121a2e', // Latar belakang Card/Nav
                800: '#1f2937', // Latar belakang input/hover
                700: '#334155', // Border
                400: '#94a3b8', // Teks muted
                300: '#cbd5e1', // Teks
                100: '#f1f5f9', // Teks heading
                }
            }
        }
    }
}
    </script>
</head>
<body class="h-full text-slate-300"> <div class="min-h-full">
    <nav class="bg-slate-900 shadow-lg"> <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="index.php?page=home" class="text-slate-100 font-bold text-xl">
                            Katalog<span class="text-blue-500">OOP</span>
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <?php 
                                $navItems = [
                                    'home' => 'Home',
                                    'categories' => 'Kategori',
                                    'brands' => 'Brand',
                                    'products' => 'Produk'
                                ];
                            
                                foreach ($navItems as $pageName => $title):
                                    $activeClass = getActiveClass($pageName, $currentPage);
                            ?>
                                <a href="index.php?page=<?php echo $pageName; ?>"
                                    class="<?php echo $activeClass; ?> rounded-md px-3 py-2 text-sm font-medium transition-colors duration-150">
                                    <?php echo $title; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-slate-800 shadow-sm border-b border-slate-700">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
        <?php
            // Cek apakah ada pesan error di session
            if (isset($_SESSION['error_message'])) {
                echo '
                <div class="mb-4 rounded-md border border-red-400 bg-red-900/50 p-4">
                    <p class="text-sm font-medium text-red-200">' . htmlspecialchars($_SESSION['error_message']) . '</p>
                </div>
                ';
                // Hapus pesan agar tidak muncul lagi
                unset($_SESSION['error_message']);
            }
        ?>
            <h1 class="text-xl font-semibold tracking-tight text-slate-100">
                <?php
                    // Logika untuk menampilkan judul halaman
                    switch($currentPage) {
                        case 'categories': echo 'Manajemen Kategori'; break;
                        case 'brands': echo 'Manajemen Brand'; break;
                        case 'products': echo 'Manajemen Produk'; break;
                        default: echo 'Dashboard';
                    }
                ?>
            </h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="bg-slate-900 shadow-xl rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
