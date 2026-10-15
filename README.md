# Super Healthcare (WordPress child theme)

Parent theme: **Twenty Twenty-Five**. Copy this folder to `wp-content/themes/super-healthcare` and activate it.

## Setup

1. Install and activate [Twenty Twenty-Five](https://wordpress.org/themes/twentytwentyfive/).
2. Activate **Super Healthcare** (pages are created on activation, or run setup manually).
3. Configure **Settings → Super Healthcare** (phone, email, CQC URL, enquiry inboxes, SA availability).
4. Optional: **Tools → Super Healthcare pages** or `wp shc create-pages` to sync the page tree.

## Templates

Routing is handled in `functions.php` via `template_include` (not the block template hierarchy). Mapped templates live in `/templates/`.

Service copy for DomCare is in `inc/services.php`; five sibling services have TODO placeholders.

## Development

Static HTML sources remain in the repo root (`src/`, `partials/`). To refresh converted body partials after editing `src/` (except `domcare`, `page`, `contact`):

```bash
python super-healthcare/tools/convert_bodies.py
python super-healthcare/tools/patch_dynamic.py
```
