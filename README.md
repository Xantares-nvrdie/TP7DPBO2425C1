# TP6DPBO2425C1
TUGAS PRAKTIKUM 6 DPBO GAMEDEV
# Flappy Bird (Java Swing Project)
Sebuah adaptasi game Flappy Bird klasik yang dibuat menggunakan Java Swing. Proyek ini menerapkan konsep-konsep inti PBO, termasuk enkapsulasi, penanganan event (Keyboard & Action Listener), dan rendering grafis kustom dengan `JPanel` dan `Timer`.

## 🙏 Janji
Saya Putra Bintang Fajar Putra Pamungkas dengan NIM 2405073 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## 🎮 Fitur Utama
- 🐤 Gameplay Flappy Bird klasik dengan fisika gravitasi.
- 💥 Sistem deteksi tabrakan yang akurat untuk pipa dan batas layar.
- 🏆 Penghitungan skor *real-time* setiap kali berhasil melewati sepasang pipa.
- 🔁 Fungsi *restart* cepat dengan menekan tombol **R** setelah *game over*.
- 🧭 GUI Menu Utama yang bersih dengan opsi **Play** dan **Exit**.
- 🌇 Aset grafis (latar belakang, pemain, pipa) yang di-render dinamis.

## 💬 Kontrol
| Input | Fungsi |
| --- | --- |
| **Space** | Membuat burung melompat (memberi velocity Y negatif) |
| **R** | Memulai ulang permainan dari awal (hanya saat *game over*) |
| **Tombol Exit** | Menutup aplikasi |

## Deskripsi Kelas

### ❗️ `App.java`
**Fungsi:** Kelas utama yang menjalankan aplikasi.
Bertugas menginisialisasi window utama (`JFrame`) dan menampilkan `MainMenuPanel` sebagai tampilan pertama saat program dibuka.

### ❗️ `MainMenuPanel.java`
**Fungsi:** Panel untuk menu awal permainan.
Menampilkan dua tombol: "Play Game" dan "Exit". Panel ini memiliki gambar latar dan tombol-tombol yang sudah di-styling.
- **Tombol Play:** Memulai game dengan menghapus panel ini dan menambahkan panel `View`.
- **Tombol Exit:** Menutup aplikasi (`System.exit(0)`).

### ❗️ `Logic.java`
**Fungsi:** Otak dari permainan. Mengelola semua event, status, dan pergerakan objek.
Kelas ini mengimplementasikan `ActionListener` (untuk *game loop*) dan `KeyListener` (untuk input pemain).

**Atribut Penting:**
- `player` (`Player`): Objek pemain (burung).
- `pipes` (`ArrayList<Pipe>`): Menyimpan semua pipa yang sedang aktif di layar.
- `gameOver` (`boolean`): Penanda status permainan (berlangsung atau sudah berakhir).
- `score` (`double`): Menyimpan skor saat ini.
- `scoreLabel` (`JLabel`): Komponen Swing untuk menampilkan skor ke `View`.
- `gameLoop` (`Timer`): Mengatur *game tick* (60 FPS) untuk memanggil metode `move()`.
- `pipesCooldown` (`Timer`): Mengatur interval kemunculan pipa baru.

**Metode Penting:**
- `move()`: Mengupdate posisi burung (menerapkan gravitasi) dan posisi semua pipa. Juga mengecek tabrakan dan skor.
- `placePipes()`: Membuat sepasang pipa baru (atas dan bawah) dengan celah acak.
- `restartGame()`: Mengatur ulang semua variabel game ke posisi awal.
- `collision()`: Fungsi helper untuk mendeteksi tabrakan antara `Player` dan `Pipe`.
- `keyPressed()`: Mendeteksi input **SPACE** untuk lompat dan **R** untuk restart.

### ❗️ `View.java`
**Fungsi:** Bertanggung jawab untuk me-render semua elemen grafis ke layar.
Kelas ini adalah `JPanel` yang digambar ulang setiap *frame* oleh `gameLoop` di `Logic`.

**Atribut Penting:**
- `logic` (`Logic`): Referensi ke *game engine* untuk mendapatkan data (posisi objek, status game over, skor).
- `backgroundImage` (`Image`): Gambar latar belakang *in-game*.
- `gameOverImage` (`Image`): Gambar yang muncul saat kalah.

**Metode Penting:**
- `paintComponent(Graphics g)`: Metode override dari `JPanel` yang menjadi pintu utama untuk menggambar.
- `draw(Graphics g)`: Dipanggil oleh `paintComponent` untuk menggambar semua aset: latar belakang, burung, semua pipa, dan gambar/teks *game over*.

### ❗️ `Player.java`
**Fungsi:** Kelas data (POJO) untuk merepresentasikan objek burung.
Hanya berisi atribut, konstruktor, serta *getter* dan *setter*.

**Atribut Penting:**
- `posX`, `posY` (`int`): Koordinat burung di layar.
- `width`, `height` (`int`): Ukuran gambar burung.
- `velocityY` (`int`): Kecepatan jatuh/lompat burung.
- `image` (`Image`): Sprite (gambar) burung.

### ❗️ `Pipe.java`
**Fungsi:** Kelas data (POJO) untuk merepresentasikan objek pipa.
Mirip dengan `Player`, kelas ini hanya menyimpan data.

**Atribut Penting:**
- `posX`, `posY` (`int`): Koordinat pipa di layar.
- `width`, `height` (`int`): Ukuran gambar pipa.
- `passed` (`boolean`): Penanda apakah pipa ini sudah dilewati oleh pemain (untuk menghitung skor).
- `image` (`Image`): Sprite pipa (atas atau bawah).

## Alur Program
1.  **Inisialisasi Program**
    * `App.java` dieksekusi, yang berfungsi sebagai titik masuk.
    * Sebuah `JFrame` (window utama) dibuat.
    * Objek `MainMenuPanel` dibuat dan ditambahkan ke `JFrame`.
    * Menu utama dengan gambar latar dan dua tombol (`Play`, `Exit`) ditampilkan ke pengguna.

2.  **Interaksi Menu Utama**
    * Program menunggu `ActionListener` dari tombol-tombol.
    * Jika pengguna menekan "Exit", program akan ditutup (`System.exit(0)`).
    * Jika pengguna menekan "Play Game", metode `startGame()` di dalam `MainMenuPanel` akan dipanggil.

3.  **Transisi ke Game**
    * Metode `startGame()` menghapus `MainMenuPanel` dari `JFrame`.
    * Objek `Logic` (sebagai otak game) dan `View` (sebagai panel grafis) baru dibuat.
    * `View` ditambahkan ke `JFrame`, dan `View` meminta `requestFocusInWindow()` agar siap menerima input keyboard.

4.  **Game Loop Berjalan (Gameplay)**
    * Saat `Logic` dibuat, dua `Timer` (yaitu `gameLoop` dan `pipesCooldown`) secara otomatis dimulai.
    * **`pipesCooldown`**: Setiap 1.5 detik, memanggil metode `placePipes()` untuk memunculkan sepasang pipa baru di sisi kanan layar.
    * **`gameLoop`**: Berjalan 60 kali per detik (~16ms). Setiap *tick*, ia memanggil `actionPerformed` di `Logic`, yang kemudian:
        * Memanggil metode `move()` (jika `!gameOver`).
        * Memanggil `view.repaint()` untuk menggambar ulang layar.
    * **Input Pemain**: Saat pemain menekan **SPACE**, `KeyListener` di `Logic` mendeteksinya dan memanggil `player.setVelocityY(-10)` untuk membuat burung melompat.

5.  **Logika di Dalam `move()`**
    * Metode ini menerapkan gravitasi pada `Player` (`velocityY + gravity`).
    * Ia menggerakkan setiap `Pipe` dalam `ArrayList` ke kiri (`pipeVelocityX`).
    * Ia mengecek apakah `Player` sudah melewati `Pipe` (untuk menambah `score`).
    * Ia memanggil `collision()` untuk mengecek tabrakan dengan pipa atau batas bawah layar.

6.  **Kondisi Game Over**
    * Jika `collision()` mengembalikan `true`, atau jika pemain jatuh (`player.getPosY() >= frameHeight`):
        * Variabel `gameOver` di `Logic` diatur ke `true`.
        * `Timer` `gameLoop` dan `pipesCooldown` segera dihentikan (`.stop()`).
        * `View` (dalam metode `draw()`) kini akan menggambar gambar "Game Over" dan teks "Press 'R' to restart".

7.  **Restart Game**
    * Dalam kondisi *game over*, pemain menekan tombol **R**.
    * `KeyListener` di `Logic` mendeteksi ini dan memanggil `restartGame()`.
    * Metode `restartGame()` akan:
        * Mereset posisi `Player` dan `score`.
        * Mengosongkan `ArrayList` `pipes`.
        * Mengatur `gameOver` kembali ke `false`.
        * Menyalakan kembali kedua `Timer` (`gameLoop.start()`, `pipesCooldown.start()`).
    * Alur program kembali ke langkah #4 (Game Loop Berjalan).

## 📸 Tampilan Game
https://github.com/user-attachments/assets/5db1feae-afdd-4420-8566-3fcb0782943b


