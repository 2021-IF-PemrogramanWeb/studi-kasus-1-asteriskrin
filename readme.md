## Dokumentasi

## Install

Buat tabel `users`.
```sql
CREATE TABLE IF NOT EXISTS users (
        u_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        u_username VARCHAR(32) NOT NULL UNIQUE,
        u_password VARCHAR(33) NOT NULL,
        u_name VARCHAR(32) NOT NULL
);
```

Buat tabel `interlocks`.
```sql
CREATE TABLE IF NOT EXISTS interlocks (
        i_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        i_timeon DATETIME NOT NULL,
        i_timeoff DATETIME NOT NULL,
        i_ack INT,
        i_reasonid INT NOT NULL,
        FOREIGN KEY (i_ack) REFERENCES users (u_id) 
);
```

Buat tabel `interlocks_dis`.
```sql
CREATE TABLE `interlocks_dis` (
        i_id INT NOT NULL,
        u_id INT NOT NULL,
        FOREIGN KEY (i_id) REFERENCES interlocks (i_id),
        FOREIGN KEY (u_id) REFERENCES users (u_id)
);

Buka `seeder.php` untuk meng-insert data testing.