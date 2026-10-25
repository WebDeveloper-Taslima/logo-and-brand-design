# WEB SECURITY & COMPLIANCE ARCHITECTURE SPECIFICATION
## Iron & Leaf Cultivation Co. (Craft Cannabis & Motorcycle Club Startup)

---

### 1. Executive Security & Compliance Overview
Operating an online presence for a legal cannabis cultivation startup founded by a motorcycle club demands strict adherence to both **state regulatory compliance** and **high-assurance web application security**. Legal cannabis websites face heightened regulatory scrutiny regarding underage access, customer privacy, and distributed denial-of-service (DDoS) threats.

This codebase is built to satisfy every security requirement outlined below.

---

### 2. Mandatory 21+ Age Verification Gate
- **Regulatory Requirement:** State laws strictly prohibit marketing or displaying cannabis products to individuals under 21 years of age.
- **Implementation Strategy:**
  1. **Client-Side Interceptor:** A full-screen overlay (`#ageGateModal`) initializes before DOM content rendering and locks body scroll.
  2. **Encrypted Persistence:** Upon verification, an encrypted flag with an ISO timestamp is stored in `localStorage` and a secure browser cookie:
     ```javascript
     document.cookie = "iron_leaf_age_gate=21_verified; path=/; max-age=2592000; SameSite=Strict; Secure";
     ```
  3. **Strict Age Exit Redirection:** Users clicking "Exit" are permanently routed away to public education resources (`responsibility.org`).

---

### 3. Anti-CSRF (Cross-Site Request Forgery) Protection
- **Vulnerability Defense:** Prevents unauthorized submission of wholesale inquiries or member details via third-party forged requests.
- **Vanilla PHP Implementation:**
  - Client generates a 128-bit cryptographically secure pseudorandom token using the browser's Web Crypto API (`window.crypto.getRandomValues`).
  - Token is stored in `sessionStorage` and attached to all outgoing POST payloads.
  - PHP validates that the token meets entropy requirements before processing.
- **WordPress Integration:**
  - Implements WordPress Nonces via `wp_create_nonce('iron_leaf_secure_inquiry_nonce')`.
  - Backend validation enforced with `check_ajax_referer('iron_leaf_secure_inquiry_nonce', 'csrf_token')`.

---

### 4. Zero-Friction Anti-Bot Honeypot Defense
- **Methodology:** Rather than degrading customer experience with clunky CAPTCHAs, a hidden form field (`biker_secret_field`) is rendered off-screen and invisible to human users (`tabindex="-1"`, `opacity: 0`).
- **Detection Mechanism:** Automated bots parse and autofill all form fields. If the honeypot field contains any string, the request is immediately dropped without alerting the bot.

---

### 5. Input Sanitization & XSS / SQLi Defense
- **Strict Whitelist & Typing:**
  - **Full Name:** Limited to alphabetical characters, apostrophes, hyphens, and whitespace (`2-100` characters).
  - **Email:** Validated via `filter_var($email, FILTER_VALIDATE_EMAIL)` and sanitized with `FILTER_SANITIZE_EMAIL`.
  - **CRLF Injection Prevention:** Checks for newline injection characters (`\r` and `\n`) in header fields to prevent SMTP header tampering.
  - **Message Body:** Sanitized with `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.

---

### 6. IP-Based Rate Limiting & DoS Mitigation
- To prevent form flooding and automated dictionary attacks against wholesale inquiries, a token-bucket rate limiter tracks IP hashes (`hash('sha256', $ip . $salt)`).
- **Rule:** A maximum of 5 submissions per 10-minute window per IP. Exceeding requests receive an HTTP `429 Too Many Requests` status code.

---

### 7. HTTP Security Headers (.htaccess & Apache/Nginx)
The `.htaccess` file provides production-ready server defense:
```apache
# Prevent Clickjacking
Header set X-Frame-Options "SAMEORIGIN"

# Prevent MIME-type Sniffing
Header set X-Content-Type-Options "nosniff"

# XSS Protection for Legacy Browsers
Header set X-XSS-Protection "1; mode=block"

# Referrer Policy
Header set Referrer-Policy "strict-origin-when-cross-origin"

# Hardware Permissions Lockdown
Header set Permissions-Policy "camera=(), microphone=(), geolocation=(), payment=()"

# Content Security Policy (CSP)
Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com; font-src 'self' https://fonts.gstatic.com data:; img-src 'self' data: https:; connect-src 'self';"

# Disable Directory Browsing
Options -Indexes -MultiViews

# Block Access to Sensitive Files (.env, .git, .sql, .log)
<FilesMatch "^(\.env|\.git|\.htaccess|\.htpasswd|composer\.(json|lock)|package\.(json|lock)|\.sql|\.log|\.bak|\.ini)$">
    Require all denied
</FilesMatch>
```

---

### 8. WordPress Hardening Checklist
1. **Disable XML-RPC:** Handled in `inc/security.php` via `add_filter('xmlrpc_enabled', '__return_false')`.
2. **Block Username Enumeration:** Handled in `inc/security.php` to prevent `/?author=1` queries.
3. **Hide WP Version Number:** Generator tag and asset query strings (`ver=...`) stripped.
4. **Dashboard File Editing:** Add the following to your root `wp-config.php`:
   ```php
   define('DISALLOW_FILE_EDIT', true);
   ```
5. **Secure Database Prefix:** Change default `wp_` prefix to a randomized string (e.g., `inl_884_`).
