<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-slate-100">Daftar Kategori</h2>
    <a href="index.php?page=categories&action=form" 
        class="inline-block rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 transition-colors duration-150">
        + Tambah Kategori
    </a>
</div>

<div class="overflow-x-auto rounded-lg border border-slate-700">
    <table class="min-w-full divide-y-2 divide-slate-700 bg-slate-900 text-sm">
        <thead class="bg-slate-800">
            <tr>
                <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-slate-400 uppercase tracking-wider">ID</th>
                <th class="whitespace-nowrap px-4 py-3 text-left font-medium text-slate-400 uppercase tracking-wider">Nama Kategori</th>
                <th class="px-4 py-3"></th> </tr>
        </thead>

        <tbody class="divide-y divide-slate-700">
            <?php foreach ($categories as $cat): ?>
            <tr class="hover:bg-slate-800 transition-colors duration-150">
                <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-100">
                    <?php echo $cat['id']; ?>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-right space-x-2">
                    <a href="index.php?page=categories&action=form&id=<?php echo $cat['id']; ?>" 
                        class="inline-block rounded bg-yellow-500 px-3 py-2 text-sm font-medium text-slate-900 hover:bg-yellow-400 transition-colors duration-150">
                        Edit
                    </a>
                    <a href="index.php?page=categories&action=delete&id=<?php echo $cat['id']; ?>" 
                        class="inline-block rounded bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700 transition-colors duration-150"
                        onclick="return confirm('Yakin ingin menghapus?');">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
