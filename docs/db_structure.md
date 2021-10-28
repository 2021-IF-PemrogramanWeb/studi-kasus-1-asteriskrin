## Dokumentasi

## Install

Buat tabel `users`.
```sql
CREATE TABLE IF NOT EXISTS users (
        u_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        u_username VARCHAR(32) NOT NULL UNIQUE,
        u_password VARCHAR(33) NOT NULL);
```

Isi tabel `users` dengan data dummy.
```sql
INSERT INTO users (u_username, u_password) VALUES ('aya@domain.net', MD5('qwerty123'));
INSERT INTO users (u_username, u_password) VALUES ('hana@domain.net', MD5('doNoThAcKmYAcC0UnT!!'));
INSERT INTO users (u_username, u_password) VALUES ('rubi@domain.net', MD5('modeRnProblemRequIreMoDernSolutiOn')); 
```