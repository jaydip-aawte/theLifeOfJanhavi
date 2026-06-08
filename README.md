# 💓 TheLifeOfJanhavi 💓

A digital emotional scrapbook built with love for Janhavi — a handcrafted digital world of memories, laughter, dreams and countless emotions.

> This is not just a website. This is a small world built from memories. 🌸

---

## ✨ Phase 1 — What's included

| Area | Status |
|------|--------|
| Folder architecture (MVC-inspired) | ✅ |
| Database schema (`admins`, `menus`, `landing_page`, `settings`) | ✅ |
| Base MVC setup (router, front controllers, models) | ✅ |
| Authentication (bcrypt, CSRF, secure sessions, rate limiting) | ✅ |
| Landing experience (fullscreen blurred modal) | ✅ |
| Scrapbook homepage (hero from DB, nav cards by rank) | ✅ |
| Music framework (floating button, play/pause, **no autoplay**) | ✅ |
| Admin dashboard skeleton + full menu | ✅ |
| Responsive design system (pink/rose/peach/lavender/cream) | ✅ |
| Marathi + Emoji support (`utf8mb4`, Noto Sans Devanagari) | ✅ |
| SEO meta + Open Graph + lazy loading (Intersection Observer) | ✅ |

Modules deferred to **Phase 2**: Quiz, Wish modules, Love Treasure, Fun Area, Suggestions, advanced CRUD, Excel import.

---

## 🧱 Tech Stack

- **PHP 8+** with **PDO prepared statements**, MVC-inspired structure
- **MySQL** (`utf8mb4` / `utf8mb4_unicode_ci`)
- **HTML5 + CSS3 + Vanilla JavaScript** (no React/Angular/Node)
- Fonts: Poppins, Playfair Display, Dancing Script, Noto Sans Devanagari

---

## 📁 Folder Structure

```
project-root/
├── admin/              # Admin front controller (physical /admin/ entry)
├── assets/
│   ├── css/            # style.css, admin.css
│   ├── js/             # app.js
│   ├── images/         # placeholders + uploads target
│   ├── uploads/        # user uploads (writable)
│   └── music/          # background music (writable)
├── config/             # app.php, database.php, Database.php, session.php
├── controllers/        # Base, Home, Auth, Admin, Api
├── models/             # Base, Admin, LandingPage, Menu, Setting
├── views/              # layouts, home, auth, admin
├── modules/            # Phase 2+ modules
├── database/           # schema.sql, seed.sql
├── index.php           # Public front controller
└── .htaccess           # Routing + security headers
```

---

## 🚀 Deployment on cPanel (ZIP upload)

1. **Create the database** in cPanel → *MySQL Databases*. Note the DB name, user, and password.
2. **Import schema**: in *phpMyAdmin*, import `database/schema.sql`, then `database/seed.sql`.
   - If your host prefixes DB names, edit the `USE` line / `CREATE DATABASE` in the SQL, or just import the table statements into your existing DB.
3. **Configure credentials**: set environment variables, OR edit `config/database.php` defaults:
   ```php
   'host'     => 'localhost',
   'dbname'   => 'youruser_life_of_janhavi',
   'username' => 'youruser_dbuser',
   'password' => 'your-db-password',
   ```
4. **Set the base URL** in `config/app.php` (`base_url`) to your domain, e.g. `https://janhavi.example.com`.
5. **Upload**: zip the project contents and upload to `public_html` (or a subfolder) via cPanel *File Manager* → *Upload* → *Extract*.
6. **Permissions**: make `assets/uploads/` and `assets/music/` writable (`chmod 755`).
7. Visit your domain. 🎉

### Default admin login

```
URL:      https://yourdomain/admin/
Username: admin
Password: admin123
```

> ⚠️ **Change these immediately.** Generate a new bcrypt hash and update the `admins` table:
> ```php
> php -r 'echo password_hash("YOUR_NEW_PASSWORD", PASSWORD_BCRYPT, ["cost" => 12]);'
> ```

---

## 🖥️ Local Development

```bash
# From the project root
php -S localhost:8000 router.php
# Open http://localhost:8000
```

The site runs without a database (it falls back to default demo content). For full functionality (admin login), configure MySQL and import the SQL files.

---

## 🔐 Security Notes

- Passwords hashed with **bcrypt** (cost 12)
- **CSRF tokens** on all forms
- **Secure sessions**: HttpOnly, SameSite=Lax, strict mode, session regeneration on login
- **Rate limiting**: 5 attempts / 15 minutes per IP
- **PDO prepared statements** everywhere
- Sensitive directories blocked via `.htaccess`

Made with 💓 for Janhavi — तू खूप खास आहेस 🌸
