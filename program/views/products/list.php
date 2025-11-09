<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-slate-100">Daftar Produk</h2>
    <a href="index.php?page=products&action=form" 
        class="inline-block rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 transition-colors duration-150">
        + Tambah Produk
    </a>
</div>

<div class="overflow-x-auto rounded-lg border border-slate-700">
    <table class="min-w-full divide-y-2 divide-slate-700 bg-slate-900 text-sm">
        <thead class="bg-slate-800">
            <tr>
                <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-slate-400 uppercase tracking-wider">Nama Produk</th>
                <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-slate-400 uppercase tracking-wider">Kategori</th>
                <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-slate-400 uppercase tracking-wider">Brand</th>
                <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-slate-400 uppercase tracking-wider">Harga</th>
                <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-slate-400 uppercase tracking-wider">Stok</th>
                <th class="px-4 py-3"></th> </tr>
        </thead>

        <tbody class="divide-y divide-slate-700">
            <?php foreach ($products as $prod): ?>
            <tr class="hover:bg-slate-800 transition-colors duration-150">
                <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-100">
                    <?php echo htmlspecialchars($prod['name']); ?>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                    <?php echo htmlspecialchars($prod['category_name'] ?? 'N/A'); ?>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                    <?php echo htmlspecialchars($prod['brand_name'] ?? 'N/A'); ?>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                    Rp <?php echo number_format($prod['price'], 0, ',', '.'); ?>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                    <?php echo $prod['stock']; ?>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-right space-x-2">
                    <a href="index.php?page=products&action=form&id=<?php echo $prod['id']; ?>" 
                        class="inline-block rounded bg-yellow-500 px-3 py-2 text-sm font-medium text-slate-900 hover:bg-yellow-400 transition-colors duration-150">
                        Edit
                    </a>
                    <a href="index.php?page=products&action=delete&id=<?php echo $prod['id']; ?>" 
                        class="inline-block rounded bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700 transition-colors duration-150"
                        onclick="return confirm('Yakin ingin menghapus produk ini?');">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
