# ARSITEKTUR SISTEM SPA BERDASARKAN IMPLEMENTASI MODULAR - FITUR

Sistem menggunakan arsitektur SPA dinamis di mana halaman tidak melakukan *reload* penuh. Route tetap dikelola oleh Laravel, namun rendering bersifat SPA dengan konten yang dimuat secara dinamis ke dalam kontainer utama.

---

## 1. ALUR KERJA SISTEM (FLOW)

| Tahap | Proses / Komponen | Deskripsi |
| :--- | :--- | :--- |
| **1** | **ENTRY SPA (`/app`)** | Route entry point utama dari aplikasi. |
| **2** | **Layout Blade Utama** | Meload file `Index/index.blade.php` sebagai Master Layout SPA. |
| **3** | **Sidebar Modular** | Meload menu navigasi di sisi kiri (dibangun dari backend). |
| **4** | **Load Page via AJAX** | Menggunakan `core.js` untuk memuat konten tanpa *reload* browser. |
| **5** | **Modul Controller &rarr; Fitur**| Controller mereturn *partial view* untuk disuntikkan ke tampilan. |

---

## 2. STRUKTUR LAYOUT UTAMA (INDEX)

Layout utama merakit beberapa *blade component* menjadi satu kesatuan:

| Komponen Blade | Elemen HTML Utama | Fungsi |
| :--- | :--- | :--- |
| `@include('Index.header')` | `<header>` | Memuat Navbar atas. |
| `@include('Index.modal_menu')` | `<div class="col_sidebar">` | Memuat Sidebar modular. |
| *(Dinamis via AJAX)* | `<main class="main_container">` | Area *mounting* konten utama SPA. |
| `@include('template.alert_flasher')` | - | Menampilkan notifikasi/alert. |
| `@include('Index.footer')` | `<footer>` | Memuat bagian bawah aplikasi. |
| `@include('File.modal_select_file')`| - | Komponen modal global untuk file. |

---

## 3. MEKANISME LOAD DINAMIS SPA

Konten halaman tidak dirender langsung oleh route, melainkan dikendalikan oleh **`core.js`** dan **`core_route.js`**. 

**Alur Eksekusi (Klik Menu ke Render):**
1. Klik Menu Sidebar.
2. JS membaca atribut `data-page` (Contoh: `data-page="https://[URL]/fsm/project"`).
3. Fungsi `load_page(url)` dijalankan.
4. Terjadi AJAX GET ke route Laravel (Contoh: `/fsm/project`).
5. *View* modul diterima dan dimasukkan ke `<main class="main_container">`.

---

## 4. STRUKTUR SIDEBAR MODULAR

Sidebar dibangun dari class `Menu` (`controllers/Menu.php`) dan diimplementasikan di `Index.php`. Data dibagi menjadi 2 jenis:

| Jenis | Perilaku (Behavior) |
| :--- | :--- |
| **MODUL** | Menampilkan *header* modul yang bisa di-expand/collapse, berisi sub-fitur. |
| **MENU** | Langsung menjadi *link* eksekusi fitur tunggal (memiliki `data-page`). |

---

## 5. STRUKTUR MODULAR CONTROLLER & ROUTING

Controller disimpan di `App\Http\Controllers\Modul\`. Pola routing yang terbentuk adalah `/{modul}/{fitur}`.

| Modul Aktif | Contoh Route URL yang Dihasilkan |
| :--- | :--- |
| `Modul_dashboard` | `/dashboard` |
| `Modul_account` | `/account/level` |
| `Modul_FSM` | `/fsm/project` |
| `Modul_transaksi` | `/transaksi/transaksi_pengeluaran` |
| `Modul_teknisi` | `/teknisi/monitoring` |
| `Modul_user` | `/user/tambah_project` |

---

## 6. ARSITEKTUR JAVASCRIPT SPA

Layer JS terbagi menjadi dua kategori utama agar rapi:

| Kategori | File JS | Fungsi / Tanggung Jawab |
| :--- | :--- | :--- |
| **APP CORE** | `app.js` | Logika dan konfigurasi utama aplikasi. |
| **APP CORE** | `api.js` | Tempat *base asynchronous* (URL Route & Request method SPA). |
| **SPA CORE** | `core.js` | Sistem utama *load* halaman (AJAX core). |
| **SPA CORE** | `core_route.js` | Mapping route SPA di sisi *client*. |
| **SPA CORE** | `core_table.js` | Fungsionalitas tabel dinamis. |
| **SPA CORE** | `core_monitoring.js`| Fungsionalitas spesifik untuk monitoring. |
| **SPA CORE** | `search_filter.js` | Mesin pencari dan filter SPA. |
| **SPA CORE** | `main.js` | *Entry script* SPA dan penempatan *event listener* utama. |

---

## 7. ANIMASI LOAD & FILOSOFI

**Sistem Animasi:**
Menggunakan class `.animasi_loadPage` untuk menampilkan efek *loading* saat AJAX berjalan dan menyembunyikan konten lama sebelum render selesai.

**Filosofi Arsitektur:**
1. **Single Layout SPA:** Semua modul berbagi satu layout utama.
2. **Modular Controller:** Domain bisnis dipisah rapi.
3. **AJAX-based Navigation:** Tanpa *reload* browser.
4. **Dynamic Sidebar:** Menu dirender dari data *backend*.
5. **Role & Permission:** Hak akses dikontrol via filter Sidebar + *Permission* per route.