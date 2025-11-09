<div class="text-center p-8">

    <div class="flex justify-center mb-4">
    <dotlottie-wc
        src="https://lottie.host/02444575-d746-40f3-b1c6-aede60a95caf/Ol84cOaSIu.lottie"
        style="width: 300px;height: 300px"
        autoplay
        loop
    >
    </dotlottie-wc>
    </div>

    <h2 class="text-3xl font-bold tracking-tight text-slate-100 sm:text-4xl min-h-[44px] sm:min-h-[52px]">
        <span id="typing-headline"></span>
    </h2>

    <p class="mt-6 text-lg leading-8 text-slate-400">
        Temukan berbagai produk elektronik berkualitas dengan harga terbaik di katalog kami. Jelajahi koleksi lengkap kami sekarang juga!
    </p>

    <div class="mt-10 flex items-center justify-center gap-x-6">
        <a href="index.php?page=products" 
            class="rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-150">
            Lihat Semua Produk
        </a>
        <a href="index.php?page=categories" 
            class="text-sm font-semibold leading-6 text-blue-400 hover:text-blue-300 transition-colors duration-150">
            Kelola Kategori <span aria-hidden="true">&rarr;</span>
        </a>
    </div>
</div>

<script
    src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js"
    type="module"
></script>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

<script>
    // Menjalankan script setelah halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', (event) => {
        new Typed('#typing-headline', {
            strings: ['Selamat Datang di Katalog Elektronik','Dua Tiga Tutup Botol', 'Jangan lupa bahagia!'],
            typeSpeed: 50,
            startDelay: 900, 
            showCursor: true,
            cursorChar: '_',
            loop: true
        });
    });
</script>
