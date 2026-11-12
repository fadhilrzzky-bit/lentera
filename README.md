# GrantFlow (Laravel + Supabase)

Landing page -> Login/Register -> Dashboard (Overview, Scholarships, Selection Funnel, Manage Data, AI Assistant demo).

## Setup di Mac
```bash
brew install php composer node     # sekali saja
composer install
cp .env.example .env
php artisan key:generate
# isi DB_* di .env dari Supabase (Session pooler)
php artisan migrate --seed         # buat tabel users + scholarships + data simulasi
php artisan serve                  # http://localhost:8000
```

### Kalau tabel `users` sudah ada di Supabase (dari proyek lama)
Jangan jalankan `migrate` penuh. Jalankan hanya:
```bash
php artisan migrate --path=database/migrations/2026_11_12_000000_create_scholarships_table.php
php artisan db:seed
```
Akun lama dengan password plaintext tetap bisa login sekali, lalu otomatis di-hash.
