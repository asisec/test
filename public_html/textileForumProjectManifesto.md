# TEXTILEFORUM.NET - CORE ARCHITECTURE & OPERATIONAL BLUEPRINT

## 1. PROJECT OVERVIEW

**Project Name:** TextileForum.net
**Business Model:** A B2B (Business-to-Business) marketplace platform connecting global and local textile manufacturers, wholesalers, and buyers. Categories include wholesale fabric, yarn, industrial textile/weaving machinery, contract manufacturing (fason), and wholesale clothing (men, women, children).
**Tech Stack:** Laravel (PHP), Blade Templating, Bootstrap.

## 2. SYSTEM ARCHITECTURE & CRITICAL QUIRKS (DANGER ZONES)

This project has a non-standard Laravel directory structure. You MUST obey these architectural rules to avoid breaking the production environment:

* **The Directory Trap:** The Laravel core files are NOT in the root directory. They are encapsulated inside `public_html/core/`. All backend paths (Controllers, Models, Routes) start from `core/`.
* **Asset Management (Uploads):** You CANNOT use Laravel's default `public_path()` for image/file uploads. This will trap files inside the `core/` folder. All uploads must be routed to the actual public root using: `base_path('../assets/images/your_folder')`.
* **Frontend/Theme Mismatch:** The homepage is NOT controlled by standard `home.blade.php`. The site heavily relies on a PageBuilder plugin. The actual entry point for homepage layout and header modifications is: `core/plugins/PageBuilder/views/headers/style-one.blade.php`.

## 3. IMPLEMENTED FEATURES & BUSINESS LOGIC (DO NOT REVERT)

### A. Auth & Listing Creation Flow (Strict Security)

* **Guest Listings Disabled:** Unauthenticated users cannot post listings. The route `listing/guest/add-listing` has been stripped.
* **UX Alert System:** If a guest clicks "İlan Ekle" (Add Listing), a custom JavaScript injects a 15-second red alert box ("Önce kayıt adımlarını tamamlayın.") and auto-redirects them to the login page after 2 seconds.
* **Password Policy:** Registration requires a strict password policy enforced via Regex: Minimum 8 characters, at least 1 uppercase, 1 lowercase, and 1 number (`regex:/[a-z]/`, `regex:/[A-Z]/`, `regex:/[0-9]/`).
* **Verification Logic:** Email is REQUIRED during registration. However, Email Verification is NOT a blocker for creating a listing. The system relies on SMS/Phone verification for listings.

### B. UI/UX Layout Constraints

* **Banner Grid System:** User-uploaded banners can destroy layouts. We enforce a strict Bootstrap grid (`col-md-6`) for 4 banner slots (`top_1`, `top_2`, `bottom_1`, `bottom_2`).
* **CSS Enforcement:** All dynamic images on the frontend MUST use inline CSS to prevent aspect ratio blowouts: `style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px;"`.

### C. Technical SEO Implementations

* **Dynamic XML Sitemap:** We bypassed heavy packages and built a custom `SitemapController` that returns a Blade view (`core/resources/views/frontend/sitemap.blade.php`).
* *Crucial XML Note:* To prevent IDE syntax errors and server crashes with short open tags, the XML header is passed dynamically from the Controller using `{!! $xmlHeader !!}` instead of writing `<?xml...` directly in Blade.
* **Visually Hidden SEO Elements:** The homepage contains a visually hidden H1 tag injected into `style-one.blade.php` to satisfy Google bots without disrupting the UI. All banners have dynamic `alt` and `aria-label` attributes.

## 4. AI OPERATIONAL PROTOCOLS (HOW YOU MUST BEHAVE)

As the AI assisting this project, you are bound by these strict rules:

1. **NO TERMINAL COMMANDS:** Do not run `ls`, `pwd`, or `find` to explore directories unless explicitly requested. Assume standard Laravel paths within the `core/` structure.
2. **NO MIGRATIONS LOCALLY:** We operate via Git push to a production server. Do NOT suggest or run `composer install` or `php artisan migrate` in your environment. Just write the code; the human operator will execute server commands via SSH.
3. **SURGICAL EDITS ONLY:** When modifying a file, only provide the exact snippet or method to be changed. Do not output the entire 500-line controller unless rewriting it from scratch.
4. **REPORT BEFORE ACTION:** If instructed to change a core Middleware or Route, state the potential impact before generating the code.

## 5. UPCOMING ROADMAP (PENDING TASKS)

The next phase focuses on UI cleanup and user experience:

1. **Form Simplification:** Removing unnecessary inputs ("Alt Kategori", "Alt-Alt Kategori", "Tamir Durumu", "Ürün Durumu", "Video URL") from the listing creation forms.
2. **Media Management:** Implementing automatic image resizing (cropping/scaling) for User Profile Pictures before saving to the database, preventing validation errors for large/oddly shaped user uploads.
3. **Footer Refactoring:** Updating hardcoded contact info (Phone: +905443048490, Location: Denizli, Türkiye, IG: textileforumnet).

Acknowledge this blueprint. Reply only with: "SYSTEM BLUEPRINT INGESTED. I am ready to operate under these architectural rules. What is our first task?"


Context: Read @textileForumProjectManifesto.md (specifically Section 2 regarding the core/ directory trap).
Task: [Insert plain, concrete objective here]
Constraint 1: Do not write anything other than the exact code snippet to be replaced.
Constraint 2: Do not run terminal commands.
Constraint 3: Apply the PonyTail ladder: If it can be done natively or in one line, do not build a custom class.