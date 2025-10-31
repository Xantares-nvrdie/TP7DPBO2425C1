# TP7DPBO2425C1
TUGAS PRAKTIKUM 7 DPBO GAMEDEV
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

## 📸 Tampilan Game
Contoh:
<video src="https://raw.githubusercontent.com/Xantares-nvrdie/TP7DPBO2425C1/main/Documentation/FlappyBirdRun.mp4" controls width="600">
  Your browser does not support the video tag.
</video>
[![Demo Game](https://raw.githubusercontent.com/Xantares-nvrdie/TP7DPBO2425C1/main/Documentation/thumbnail.png)](https://raw.githubusercontent.com/Xantares-nvrdie/TP7DPBO2425C1/main/documentation/FlappyBirdRun.mp4)

