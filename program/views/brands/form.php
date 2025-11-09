<h2 class="text-2xl font-semibold text-slate-100 mb-6 pb-3 border-b border-slate-700">
    <?php echo isset($data) ? 'Edit' : 'Tambah'; ?> Brand
</h2>

<form action="index.php?page=brands&action=save" method="POST" class="space-y-6 max-w-lg">
    
    <input type="hidden" name="id" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>">
    
    <div class="justify-center items-center">
        <label for="name" class="block text-sm font-medium text-slate-400 mb-1">
            Nama Brand
        </label>
        <div class="mt-1">
            <input type="text" id="name" name="name" 
                class="block w-full rounded-md border-slate-700 bg-slate-800 text-slate-100 shadow-sm 
                        focus:border-blue-500 focus:ring-blue-500 
                        text-base px-3 py-2" 
                value="<?php echo isset($data['name']) ? htmlspecialchars($data['name']) : ''; ?>" 
                required>
        </div>
    </div>
    
    <div class="flex justify-start space-x-3 pt-4 border-t border-slate-700">
        <button type="submit" 
                class="inline-block rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 transition-colors duration-150">
            Simpan
        </button>
        <a href="index.php?page=brands"
            class="inline-block rounded-md border border-slate-700 bg-slate-800 px-4 py-2 text-sm font-medium text-slate-300 shadow-sm hover:bg-slate-700 transition-colors duration-150">
            Batal
        </a>
    </div>
</form>
