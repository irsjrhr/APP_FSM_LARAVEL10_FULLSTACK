# ARSITEKTUR ROUTING SISTEM SPA MULTI-ROLE
**Pendekatan: Aplikasi - Modul - Fitur**

Dokumen ini menjelaskan standar arsitektur routing untuk pengembangan sistem Single Page Application (SPA) berbasis Multi-Role.

---

## 1. Konsep Utama
Sistem ini menggunakan hierarki tiga tingkat untuk memastikan modularitas dan skalabilitas:

> **Aplikasi &rarr; Modul &rarr; Fitur**

**Tujuan Desain:**
* Mendukung sistem *Multi-Role* secara native.
* Pengembangan yang modular (*Modular Development*).
* Kontrol akses (*Permission*) yang granular per fitur.
* Skalabilitas jangka panjang.
* Struktur SPA yang terisolasi per role.

---

## 2. Definisi Terminologi

### A. Aplikasi (Application Layer)
* Merupakan **Entry Layer** berbasis role.
* Memiliki namespace controller sendiri.
* Bukan sekadar *View*, melainkan segmentasi domain bisnis.
* **Contoh:** `/admin`, `/teknisi`, `/user`.

### B. Modul
* Pengelompokan fitur dalam satu aplikasi berdasarkan domain bisnis.
* **Tujuan:**
    * Mencegah *Controller Bloat* (Controller terlalu besar).
    * Membuat permission lebih spesifik.

### C. Fitur
* Endpoint spesifik di dalam Modul.
* Direpresentasikan sebagai **Method** di dalam Controller.
* Dalam konteks ini, fitur bertugas me-load *View Shell* (kerangka tampilan) sebelum data diambil secara *Asynchronous*.

### Format Penamaan (Naming Convention)
| Tipe | Deskripsi | Contoh Controller |
| :--- | :--- | :--- |
| **Index** | Entry point utama untuk SPA View | `App\Http\Controllers\Admin\Index` |
| **Modul** | Fitur umum (General) | `App\Http\Controllers\Admin\Modul` |
| **Modul_{Nama}** | Fitur spesifik / kompleks | `App\Http\Controllers\Admin\Modul_account` |

---

## 3. Struktur Routing & Implementasi

### A. Admin Application
**Namespace:** `App\Http\Controllers\Admin`

| Modul | Controller | View Path | Route URL | Deskripsi |
| :--- | :--- | :--- | :--- | :--- |
| **SPA Entry** | `Index` | `Admin\Index` | `/admin/index` | Entry point Admin |
| **General** | `Modul` | `Admin\Modul` | `/admin/dashboard` | Dashboard utama |
| **Account** | `Modul_account` | `Admin\Modul_account` | `/admin/account` | Manajemen user |
| **Account** | `Modul_account` | `Admin\Modul_account` | `/admin/level` | Manajemen role |
| **FSM** | `Modul_fsm` | `Admin\Modul_fsm` | `/admin/fsm` | Logika state/workflow |
| **FSM** | `Modul_fsm` | `Admin\Modul_fsm` | `/admin/flow` | Konfigurasi alur |
| **General** | `Modul` | `Admin\Modul` | `/admin/produk` | Master data produk |
| **General** | `Modul` | `Admin\Modul` | `/admin/project` | Master data project |
| **General** | `Modul` | `Admin\Modul` | `/admin/laporan` | Reporting |
| **General** | `Modul` | `Admin\Modul` | `/admin/monitoring` | Monitoring sistem |
| **General** | `Modul` | `Admin\Modul` | `/admin/teknisi` | Data teknisi |

### B. Teknisi Application
**Namespace:** `App\Http\Controllers\Teknisi`

| Modul | Controller | View Path | Route URL |
| :--- | :--- | :--- | :--- |
| **SPA Entry** | `Index` | `Teknisi\Index` | `/teknisi/index` |
| **General** | `Modul` | `Teknisi\Index` | `/teknisi/dashboard` |
| **General** | `Modul` | `Teknisi\Index` | `/teknisi/project` |
| **General** | `Modul` | `Teknisi\Index` | `/teknisi/monitoring` |

### C. User Application
**Namespace:** `App\Http\Controllers\User`

| Modul | Controller | View Path | Route URL |
| :--- | :--- | :--- | :--- |
| **SPA Entry** | `Index` | `User\Index` | `/user/index` |
| **General** | `Modul` | `User\Modul` | `/user/dashboard` |
| **General** | `Modul` | `User\Modul` | `/user/profile` |
| **General** | `Modul` | `User\Modul` | `/user/project` |
| **General** | `Modul` | `User\Modul` | `/user/tambah_project` |
| **General** | `Modul` | `User\Modul` | `/user/monitoring` |

---

## 4. Filosofi Desain

### 1. Tidak Menggunakan Global Route Prefix Group
* **Alasan:**
    * Fleksibilitas struktur (tidak terkunci satu pola).
    * Eksplisit saat debugging (memudahkan pencarian route).
    * Memungkinkan variasi URL lintas modul jika diperlukan.

### 2. Aplikasi Bukan Layer View
* Admin, Teknisi, dan User dipisahkan secara keras (*Hard Separation*) di level Controller dan Namespace untuk keamanan dan kejelasan konteks bisnis.

### 3. Permission Granular Per Fitur
* Menu hanyalah representasi UI.
* **Permission** (Hak Akses) diletakkan pada level Controller/Method.
* Struktur Permission mengikuti alur: `Aplikasi.Modul.Fitur`.

---

## 5. Model Interaksi (Interaction Model)

Arsitektur ini berfokus pada **Frontend Routing & View Orchestration**.

1.  **Request:** User mengakses URL (misal: `/admin/produk`).
2.  **Controller:** Memvalidasi akses dan mengembalikan **View Shell** (HTML kerangka).
3.  **Client-Side:** Browser merender View Shell.
4.  **Async Data:** JavaScript pada View Shell melakukan request ke **Backend API** untuk mengambil dan menampilkan data (CRUD).

---

## 6. Kelebihan Arsitektur
* ✅ **Scalability:** Mudah dikembangkan tanpa merusak struktur lama.
* ✅ **Clarity:** Pemisahan yang jelas antara Role dan Modul.
* ✅ **API-Ready:** Sangat mudah dikonversi menjadi API-based SPA karena Controller hanya me-return View.
* ✅ **Multi-Tenant Friendly:** Struktur role yang terpisah memudahkan adaptasi ke sistem multi-tenant.