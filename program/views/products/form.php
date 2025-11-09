<h2 class="text-2xl font-semibold text-slate-100 mb-6 pb-3 border-b border-slate-700">
    <?php echo isset($data) ? 'Edit' : 'Tambah'; ?> Produk
</h2>

<form action="index.php?page=products&action=save" method="POST" class="space-y-6">
    
    <input type="hidden" name="id" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>">
    
    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

        <div class="sm:col-span-6">
            <label for="name" class="block text-sm font-medium text-slate-400 mb-1">
                Nama Produk
            </label>
            <div class="mt-1">
                <input type="text" id="name" name="name" 
                        class="block w-full rounded-md border-slate-700 bg-slate-800 text-slate-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                        text-base px-3 py-2"
                        value="<?php echo isset($data['name']) ? htmlspecialchars($data['name']) : ''; ?>" 
                        required>
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="category_id" class="block text-sm font-medium text-slate-400 mb-1">
                Kategori
            </label>
            <div class="mt-1">
                <select id="category_id" name="category_id" 
                        class="block w-full text-base px-3 py-2 rounded-md border-slate-700 bg-slate-800 text-slate-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                        text-base px-3 py-2"
                        required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" 
                            <?php echo (isset($data) && $data['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="brand_id" class="block text-sm font-medium text-slate-400 mb-1">
                Brand
            </label>
            <div class="mt-1">
                <select id="brand_id" name="brand_id" 
                        class="block w-full text-base px-3 py-2 rounded-md border-slate-700 bg-slate-800 text-slate-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                        text-base px-3 py-2"
                        required>
                    <option value="">Pilih Brand</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?php echo $brand['id']; ?>" 
                            <?php echo (isset($data) && $data['brand_id'] == $brand['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($brand['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="price" class="block text-sm font-medium text-slate-400 mb-1">
                Harga
            </label>
            <div class="mt-1">
                <input type="number" id="price" name="price" step="0.01" min="0"
                    class="block w-full rounded-md border-slate-700 bg-slate-800 text-slate-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                    text-base px-3 py-2"
                    value="<?php echo isset($data['price']) ? $data['price'] : ''; ?>" 
                    required>
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="stock" class="block text-sm font-medium text-slate-400 mb-1">
                Stok
            </label>
            <div class="mt-1">
                <input type="number" id="stock" name="stock" min="0"
                        class="block w-full rounded-md border-slate-700 bg-slate-800 text-slate-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm
                        text-base px-3 py-2"
                        value="<?php echo isset($data['stock']) ? $data['stock'] : ''; ?>" 
                        required>
            </div>
        </div>

    </div> <div class="flex justify-start space-x-3 pt-5 border-t border-slate-700">
        <button type="submit" 
                class="inline-block rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 transition-colors duration-150">
            Simpan
        </button>
        <a href="index.php?page=products"
            class="inline-block rounded-md border border-slate-700 bg-slate-800 px-4 py-2 text-sm font-medium text-slate-300 shadow-sm hover:bg-slate-700 transition-colors duration-150">
            Batal
        </a>
    </div>
</form>
