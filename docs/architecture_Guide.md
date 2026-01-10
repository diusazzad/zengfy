# Zengfy Ecosystem: Senior Engineering Architecture Guide

Building a "Google-style" ecosystem means moving from a monolithic application to a **Federated Service Architecture**. You aren't just building a website; you're building a platform where identity is centralized but services are specialized.

---

## 1. Local Networking: The "Domain Hub" Strategy
To develop 10+ subdomains locally, you need to simulate a real DNS environment.

### A. The Windows hosts File
You must map each "fake" domain to your local machine (127.0.0.1).
**Path:** `C:\Windows\System32\drivers\etc\hosts`
```text
127.0.0.1  zengfy.test
127.0.0.1  law.zengfy.test
127.0.0.1  school.zengfy.test
127.0.0.1  ecommerce.zengfy.test
127.0.0.1  pos.zengfy.test
... and so on
```

### B. The Virtual Host (Apache/XAMPP)
In your `httpd-vhosts.conf`, you define a catch-all or individual vhosts that point to your Laravel `public` folder.
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/zengfy/Github/zengfy/public"
    ServerName zengfy.test
    ServerAlias *.zengfy.test
    <Directory "C:/xampp/htdocs/zengfy/Github/zengfy/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

---

## 2. Shared Identity: The Single Sign-On (SSO) Secret
For a user to stay logged in while moving between subdomains, the **Session Cookie** must be shared.

### The .env Configuration
```env
APP_URL=http://zengfy.test
SESSION_DOMAIN=.zengfy.test
```
> [!IMPORTANT]
> The dot (`.`) before the domain tells the browser: "This cookie is valid for this domain and **all** its subdomains."

---

## 3. Dynamic Routing: One Codebase, Many Faces
Using `nwidart/laravel-modules`, we can "switch" the experience based on the subdomain.

### Routing by Domain
```php
# Conceptual Example in Laravel
Route::domain('law.zengfy.test')->group(function () {
    # Only Law module routes load here
});
```

---

## 4. Access Control: Trial vs. Paid (Entitlements)
The "Single Account" sees everything, but their **Entitlements** decide what they can click.

### B. The "Gatekeeper" Middleware
Create a middleware called `CheckModuleAccess`.
1. User clicks "School".
2. System checks subscriptions table.
3. If user_id has `school_module` active: **Allow**.
4. If not: **Redirect to billing/landing page**.

---

## 5. FAQ: Multi-Project & Port Management

### Q: Can I run other projects at the same time?
**Yes.** 
- **Zengfy**: Run via XAMPP (Port 80) using the virtual hosts above.
- **Other Projects**: Run via `php artisan serve --port=8881`. They will not conflict.

### Q: Why use Ports 2083-2093?
These ports are traditionally used for **cPanel** and **WHM**. Using them locally is fine, but port 80 is cleaner as it avoids typing the port number in the browser URL.

---

## 6. The "Senior Lead" Philosophy
**Why are we doing this?**
1. **SSO (Single Sign-On)**: User convenience. Login once, access everything.
2. **Modular Scalability**: We can add 100 modules without the main code getting messy.
3. **Market Strategy**: We create "Sticky Users." If they use one service, they are more likely to use the others.