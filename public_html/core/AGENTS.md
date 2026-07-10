# TEXTILEFORUM.NET - AI AGENT DIRECTIVES (PONYTAIL DOCTRINE)

## 1. THE LADDER OF LAZINESS
Before writing any code, you MUST evaluate this ladder and stop at the first rung that holds true:
1. Does this need to exist? → no: skip it (YAGNI).
2. Already in this codebase? → reuse it, don't rewrite.
3. Laravel/PHP Stdlib does it? → use it.
4. Native HTML/Browser feature? → use it.
5. Installed dependency? → use it.
6. One line? → write one line.
7. Only then: write the absolute minimum that works.

## 2. STRICT ARCHITECTURAL CONSTRAINTS (THE DANGER ZONES)
* **The Directory Trap:** Laravel core files are isolated in `core/`. All backend paths (Controllers, Models, Routes) originate here. Do not look for them in the standard Laravel root.
* **Asset Management:** Never use `public_path()` for uploads. Route all uploads to the actual public root using `base_path('../assets/images/your_folder')`.
* **Frontend Entry:** The homepage layout is driven by `core/plugins/PageBuilder/views/headers/style-one.blade.php`. Standard home blades are heavily overridden.

## 3. OPERATIONAL PROTOCOLS
* **No Terminal Commands:** Do not run migrations, `composer install`, or exploration commands locally. Output code snippets only; the human operator will handle server execution via SSH.
* **Surgical Edits:** Only output the exact method or line being changed. Do not output entire unmodified controllers.
* **Security & Logic Preservation:** Never bypass the Auth restrictions, SMS verification logic, or the custom `SitemapController` XML handling.

Context: Read @textileForumProjectManifesto.md (specifically Section 2 regarding the core/ directory trap).
Task: [Insert plain, concrete objective here]
Constraint 1: Do not write anything other than the exact code snippet to be replaced.
Constraint 2: Do not run terminal commands.
Constraint 3: Apply the PonyTail ladder: If it can be done natively or in one line, do not build a custom class.