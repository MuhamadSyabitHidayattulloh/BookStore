# BookStore Flowchart

## 1) High-Level Project Flow

```mermaid
flowchart TD
    A[Pengunjung buka aplikasi /] --> B{Sudah login?}

    B -- Tidak --> C[Halaman Auth: login/register]
    C --> D{Aksi user}
    D -- Register --> E[Simpan user baru role user]
    E --> F[Auto login]
    F --> G[Masuk area user /explore]
    D -- Login --> H[Validasi kredensial]
    H --> I{Valid?}
    I -- Tidak --> C
    I -- Ya --> J{Role akun}
    J -- admin --> K[Redirect /admin/dashboard]
    J -- user --> G

    B -- Ya --> J

    subgraph USER_FLOW[User Area]
        G --> U1[Explore buku + filter/search]
        U1 --> U2[Tambah buku ke cart]
        U2 --> U3[Kelola cart: qty pilih item hapus]
        U3 --> U4[Checkout]
        U4 --> U5[Validasi phone address selected items]
        U5 --> U6[DB Transaction]
        U6 --> U7[Create order + order_items]
        U7 --> U8[Kurangi stok buku]
        U8 --> U9[Hapus item cart terpilih]
        U9 --> U10[Redirect ke halaman orders]

        G --> U11[Menu contact]
        U11 --> U12[Kirim pesan contact]
    end

    subgraph ADMIN_FLOW[Admin Area]
        K --> AD1[Dashboard statistik]
        AD1 --> AD2[Kelola buku CRUD]
        AD1 --> AD3[Kelola kategori CRUD]
        AD1 --> AD4[Kelola user CRUD]
        AD1 --> AD5[Kelola order + update status]
        AD1 --> AD6[Kelola contact: read/delete]
    end

    U10 --> Z[Logout]
    AD1 --> Z
    Z --> ZA[Session invalidate + redirect login]
```

## 2) Detail Checkout Flow

```mermaid
flowchart TD
    A1[User buka cart] --> A2[Pilih item checkout]
    A2 --> A3[Klik checkout]
    A3 --> A4{Validasi form & selected items}

    A4 -- Gagal --> A5[Tampilkan error]
    A5 --> A1

    A4 -- Lolos --> A6[Mulai DB transaction]
    A6 --> A7[Update phone & address user]
    A7 --> A8[Hitung total dari item terpilih]
    A8 --> A9[Buat order status proccess]
    A9 --> A10[Loop item]
    A10 --> A11[Buat order_item]
    A11 --> A12[Kurangi stock buku]
    A12 --> A13{Masih ada item?}
    A13 -- Ya --> A10
    A13 -- Tidak --> A14[Hapus item terpilih dari cart]
    A14 --> A15[Commit transaction]
    A15 --> A16[Redirect ke user.orders + flash sukses]
```

## 3) Mapping Source Code

- Routing utama: `routes/web.php`
- Role guard: `app/Http/Middleware/RoleMiddleware.php`
- Auth flow: `app/Livewire/Auth/Index.php`
- User flow: `app/Livewire/User/Explore.php`, `app/Livewire/User/Cart.php`, `app/Livewire/User/Order.php`, `app/Livewire/User/Contact.php`
- Admin flow: `app/Livewire/Admin/Dashboard.php`, `app/Livewire/Admin/Book/Index.php`, `app/Livewire/Admin/Category/Index.php`, `app/Livewire/Admin/User/Index.php`, `app/Livewire/Admin/Order/Index.php`, `app/Livewire/Admin/Contact/Index.php`
