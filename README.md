# ARSITEKTUR SISTEM SPA BERDASARKAN IMPLEMENTASI MODULAR - FITUR

Sistem menggunakan arsitektur SPA dinamis di mana halaman tidak melakukan *reload* penuh. Route tetap dikelola oleh Laravel, namun rendering bersifat SPA dengan konten yang dimuat secara dinamis ke dalam kontainer utama.

---

## 1. ALUR KERJA SISTEM (FLOW)

| Tahap | Proses / Komponen | Deskripsi |
| :--- | :--- | :--- |
| **1** | **ENTRY SPA (`/app`)** | Route *entry point* utama dari aplikasi. |
| **2** | **Layout Blade Utama** | Meload file `Index/index.blade.php` sebagai Master Layout SPA. |
| **3** | **Sidebar Modular** | Meload menu navigasi di sisi kiri (dibangun dari backend). |
| **4** | **Load Page via AJAX** | Menggunakan `core.js` untuk memuat konten tanpa *reload* browser. |
| **5** | **Modul Controller &rarr; Fitur**| Controller me-return *partial view* untuk disuntikkan ke tampilan. |

---

## 2. ENTRY POINT & STRUKTUR LAYOUT UTAMA (INDEX)

**Entry Point Aplikasi:**
* **Route:** `/app`
* **Controller:** `App\Http\Controllers\Index`
* **View Utama:** `resources/views/Index/index.blade.php` (Sebagai **MASTER LAYOUT SPA**)

Layout utama merakit beberapa *blade component* menjadi satu kesatuan HTML:

| Komponen Blade | Elemen HTML Utama | Fungsi |
| :--- | :--- | :--- |
| `@include('Index.header')` | `<header>` | Memuat Navbar atas. |
| `@include('Index.modal_menu')` | `<div class="col_sidebar">` | Memuat Sidebar modular. |
| *(Dinamis via AJAX)* | `<main class="main_container">` | Area *mounting* konten utama SPA. |
| `@include('template.alert_flasher')` | - | Menampilkan notifikasi/alert. |
| `@include('Index.footer')` | - | Memuat bagian bawah aplikasi. |
| `@include('File.modal_select_file')`| - | Komponen modal global untuk file. |

---

## 3. MEKANISME LOAD DINAMIS SPA

Konten halaman tidak dirender langsung oleh route. Konten dimuat oleh `core.js` dan `core_route.js` dengan target ke `<main class="main_container">`.

**Alur Eksekusi (Klik Menu ke Render):**
1. Klik Menu Sidebar.
2. JS membaca atribut `data-page` (Contoh: `data-page="https://[URL]/fsm/project"`).
3. Fungsi `load_page(url)` dijalankan.
4. AJAX GET me-request route Laravel.
5. *View* modul diterima dan dimasukkan ke `main_container`.

---

## 4. STRUKTUR SIDEBAR MODULAR

Sidebar dibentuk dari `header.blade.php` di view Index. Struktur datanya dibentuk pada class `Menu` (`controllers/Menu.php`) yang diimplementasikan di `Index.php`.

| Jenis Modul | Perilaku (Behavior) |
| :--- | :--- |
| **MODUL** | Menampilkan *header* modul dan berisi beberapa fitur (bisa di-expand/collapse). |
| **MENU** | Langsung menjadi *link* eksekusi fitur tunggal (memiliki `data-page`). |

---

## 5. STRUKTUR MODULAR CONTROLLER & ROUTING

Controller disimpan di `App\Http\Controllers\Modul\`. Pola routing yang terbentuk memiliki format `/{modul}/{fitur}`. Route hanya mengembalikan *view partial*, bukan full layout.

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

Layer JS terbagi menjadi dua kategori utama (`APP CORE` dan `SPA CORE`) agar fungsionalitas mudah di-maintain:

| Kategori | File JS | Fungsi / Tanggung Jawab |
| :--- | :--- | :--- |
| **APP CORE** | `app.js` | Logika dan konfigurasi utama aplikasi. |
| **APP CORE** | `api.js` | Tempat *base asynchronous* seperti URL Route dan Request method SPA. |
| **SPA CORE** | `core.js` | Sistem utama *load* halaman. |
| **SPA CORE** | `core_route.js` | Mapping route SPA di sisi klien. |
| **SPA CORE** | `core_table.js` | *Core* load table route SPA. |
| **SPA CORE** | `core_monitoring.js`| Fungsionalitas spesifik untuk monitoring. |
| **SPA CORE** | `main.js` | *Entry script* SPA dan *event core*-nya. |
| **SPA CORE** | `table.js` | Fungsi *closure* load table. |

---

## 7. ANIMASI LOAD & FILOSOFI ARSITEKTUR

**Load Animation System:**
Sistem menggunakan elemen `.animasi_loadPage` untuk:
* Menampilkan *loading* saat AJAX request berjalan.
* Menyembunyikan konten lama sebelum load render selesai sepenuhnya.

**Filosofi Arsitektur:**
1. **Single Layout SPA:** Semua modul menggunakan satu layout utama.
2. **Modular Controller:** Setiap domain dipisahkan dalam Modul controller.
3. **AJAX-based Navigation:** Perpindahan halaman tidak me-*reload* browser.
4. **Dynamic Sidebar Rendering:** Menu dibangun dari data backend.
5. **Role & Permission:** Role bisa dikontrol via Sidebar + Permission.

---

## 8. STRUKTUR FOLDER FINAL

```text
app/
 └── Http/
     └── Controllers/
         ├── Index.php
         └── Modul/
             ├── Modul_dashboard.php
             ├── Modul_account.php
             ├── Modul_FSM.php
             ├── Modul_transaksi.php
             ├── Modul_teknisi.php
             └── Modul_user.php

resources/
 └── views/
     ├── Index/
     ├── Modul_dashboard/
     ├── Modul_account/
     ├── Modul_FSM/
     ├── Modul_transaksi/
     ├── Modul_teknisi/
     └── Modul_user/

public/
 └── asset/
     └── js/
         ├── app.js
         ├── api.js
         └── panel_spa/
             ├── core.js
             ├── core_route.js
             ├── core_table.js
             ├── core_monitoring.js
             ├── main.js
             └── table.js