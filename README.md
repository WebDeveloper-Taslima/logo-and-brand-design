# IRON & LEAF CULTIVATION CO. 🏍️🌿
### Outlaw Motorcycle Club Craft Cannabis Startup Platform

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![WordPress](https://img.shields.io/badge/WordPress-21759B?style=for-the-badge&logo=wordpress&logoColor=white)
![Web Security](https://img.shields.io/badge/Web_Security-Hardened-10B981?style=for-the-badge&logo=security&logoColor=white)

> *"Born on the Road. Grown in the Dirt."*  
> High-octane craft cannabis genetics locally cultivated in organic living soil by an independent motorcycle brotherhood.

---

## ⚡ Project Overview

This repository contains the complete brand identity, standalone front-end application, hardened backend API, and a production-ready custom WordPress theme engineered specifically for craft cannabis startups and dispensaries.

### Core Stack & Highlights:
- **Website Design & HTML5/CSS3:** Modern dark outlaw biker aesthetic, glassmorphic UI, responsive layout, and mobile-first navigation.
- **Interactive Strain Menu:** Live filterable catalog (Indica, Sativa, Hybrid) with THC/CBD potency bars, terpene profiles, and batch COA modal inspection.
- **Web Security Architecture:** Mandatory legal 21+ Age Gate, cryptographic CSRF token validation, invisible anti-bot honeypot traps, IP-based rate-limiting, and strict `.htaccess` security headers.
- **PHP Backend Handler:** Sanitized wholesale dispatch processor (`api/inquiry.php`) protecting against SQLi, XSS, and CRLF header injection.
- **Turnkey WordPress Theme:** Installable `.zip` package (`wordpress-theme/iron-and-leaf.zip`) with Custom Post Types (`strain`), lab potency meta boxes, and security hardening (XML-RPC blocked, user enumeration blocked).

---

## 📂 Repository Structure

```
├── index.html                  # Standalone live homepage (GitHub Pages ready)
├── assets/                     # Styles, scripts, and high-resolution visual assets
│   ├── css/style.css           # Custom dark theme & glassmorphic styling
│   ├── js/main.js              # Age Gate, strain filters, modals & CSRF handlers
│   └── images/                 # Biker crest emblem, hero background, craft bud photos
│
├── api/                        # Backend API endpoints
│   └── inquiry.php             # Hardened PHP wholesale dispatch handler
│
├── wordpress-theme/            # Custom WordPress theme
│   ├── iron-and-leaf.zip       # 1-Click installable theme archive
│   └── iron-and-leaf/          # Theme source code & security modules
│
├── branding-and-assets/        # Vector logos, crests & identity guides
│   ├── logo-badge.svg          # Scalable vector badge for apparel/packaging
│   ├── iron-and-leaf-logo.jpg  # Ultra high-res club patch emblem
│   └── BRAND_IDENTITY_GUIDE.md # Color palettes, typography & packaging specs
│
├── security-config/            # Comprehensive web security documentation
│   └── WEB_SECURITY_GUIDE.md   # Legal compliance & security whitepaper
│
└── .gitignore                  # Git ignore rules for clean commits
```

---

## 🚀 Live Demo with GitHub Pages

This repository is formatted so you can host the website for free directly on **GitHub Pages**:

1. Go to your repository **Settings** on GitHub.
2. In the left sidebar, click **Pages**.
3. Under **Build and deployment > Branch**, select `main` (or `master`) and folder `/ (root)`.
4. Click **Save**. Within 1 minute, GitHub will give you a live URL to share with clients!

---

## 📦 How to Install the WordPress Theme

1. In your WordPress Admin panel, navigate to **Appearance > Themes**.
2. Click **Add New Theme**, then **Upload Theme**.
3. Choose the `wordpress-theme/iron-and-leaf.zip` file from this repository.
4. Click **Install Now** and **Activate**.
5. Go to **Cannabis Vault > Add New Strain** to start adding strains with custom THC%, CBD%, and terpene metrics.

---

## 🛡️ Web Security Features

- **Legal 21+ Age Verification Gate:** Client-side interceptor with secure `SameSite=Strict` cookie persistence.
- **CSRF Token Validation:** Every inquiry dispatch is verified against 128-bit cryptographic tokens.
- **Anti-Bot Honeypot:** Invisible trap fields silently neutralize 99% of automated spam bots.
- **Rate-Limiting Defense:** Token-bucket throttling prevents DoS flooding.
- **WordPress Hardened:** XML-RPC disabled, version fingerprinting removed, and user enumeration blocked.

---

## 📄 License
Crafted for Iron & Leaf Cultivation Co. All custom assets and code licensed under the GPL v2 or later.
