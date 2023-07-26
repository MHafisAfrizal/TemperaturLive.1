# Live Temperature Reports

## Installation

1. Clone project ini menggunakan git. Jalankan pada terminal:

    ```bash
    git clone https://github.com/IhsanDevs/TemperatureLive
    ```

2. Masuk pada directory project yang telah di clone:

    ```bash
    cd TemperatureLive
    ```

    Setelah itu install semua dependency composer dan nodeJS yang dibutuhkan:

    ```bash
    composer update && npm update
    ```

3. Konfigurasi environment untuk project.

    📝 **Informasi Tambahan: _Tidak perlu konfigurasi host atau password database apapun karena project ini ini menggunakan drive sqlite sebagai database!_**

    Jalankan pada terminal:

    ```bash
    cp .env.example .env
    ```

    Atau bisa _copy-paste_ manual file `.env` menggunakan file manager.

4. Setelah menyesuaikan environment, silahkan lakukan migration.

    Jalankan pada terminal:

    ```bash
    php artisan migrate # pilih "yes", kemudian enter, jika ada pesan konfirmasi dari terminal
    ```

5. Seeding data untuk menambahkan user dan data dummy untuk room.

    Jalankan pada terminal:

    ```bash
    php artisan db:seed # pilih "yes", kemudian enter, jika ada pesan konfirmasi dari terminal
    ```

## Deployment

Untuk menjalankan pada local device, cukup gunakan fitur `artisan:serve` pada terminal:

```bash
php artisan serve
```

Untuk menjalankan pada production server, buat `symlink` untuk folder **public** pada folder project. Arahkan sesuai keinginan Anda sendiri. Contoh:

```bash
ln -s /home/{username}/path/to/project_dir/public /home/{username}/path/to/symlink_name
```

Setelah itu arahkan domain ke folder symlink yang telah dibuat.
