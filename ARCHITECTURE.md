# HacoLED Theme Architecture

HacoLED is a classic WordPress theme with a lightweight MVC-style application layer. All theme-specific behavior remains inside this theme.

## Request flow

1. WordPress selects a template entry such as `front-page.php`, `single.php`, `search.php`, or `404.php`.
2. The entry instantiates one controller from `app/Controllers`.
3. The controller obtains data through models/repositories and normalizes it for presentation.
4. The controller renders a view from `views`.
5. Views escape output and render markup; they should not create new database queries.

## Directory responsibilities

- `app/Core`: autoloading, controller rendering, and shared infrastructure.
- `app/Controllers`: request-specific orchestration.
- `app/Admin`: capability- and nonce-protected theme administration screens.
- `app/Config`: centralized theme configuration such as managed page titles, slugs, and templates.
- `app/Models`: normalized read access to WordPress and WooCommerce data.
- `app/Repositories`: query collections used by controllers and catalog pages.
- `app/Support`: native WordPress hooks and compatibility callbacks.
- `page-templates`: thin, selectable WordPress page-template entry files; each file contains a `Template Name` header and delegates to a controller.
- `views/pages`: complete presentation views for custom pages; these files contain markup and are never selected directly by WordPress.
- `views/common`: shared WordPress archive, page, and single views.
- `views/components`: reusable UI fragments.
- `views/catalog`: controller-owned shop, taxonomy, and product page views.
- `woocommerce`: WooCommerce template overrides only.
- `src`: editable frontend source.
- `assets`: compiled, deployable frontend assets.

## Rules for future changes

- Keep `functions.php` as a bootstrap only.
- Use the `HacoLED\Theme` namespace for PHP classes.
- Do not edit WordPress core or installed plugin files.
- Prefer WordPress/WooCommerce hooks and APIs over template overrides.
- Put database queries in models/repositories, not views.
- Keep WordPress hierarchy entry files at the theme root and keep them thin.
- Never place controller-owned catalog views inside `woocommerce/`; that folder is reserved for core overrides.
- Every query that changes global post data must call `wp_reset_postdata()`.
- Escape at output with the appropriate `esc_*()` function or `wp_kses_post()`.
- Add nonce, capability, autosave, and revision checks to every admin write.
- Do not ship mock/demo records as production fallbacks.
- Keep WooCommerce `@version` headers synchronized with the installed core templates.
- Run `npm run build` and PHP syntax validation before deployment.

## WordPress template ownership

- `front-page.php`: marketing homepage.
- `home.php`: posts index.
- `index.php`: final generic fallback only.
- `search.php`: search results.
- `404.php`: not-found response.
- `page.php`, `single.php`, `archive.php`, `category.php`: native hierarchy entries.
- `taxonomy-product_cat.php`: required WooCommerce taxonomy entry; it routes to `ProductController`.
- `page-templates/*`: selectable route files discovered by WordPress. They must remain thin and call `TemplateController`.
- `views/pages/*`: page markup rendered by `TemplateController`; these files must not contain `Template Name` headers.
- Legacy root `template-*.php` assignments are migrated once by `app/Support/theme-upgrades.php` and must not be recreated.
- Product templates route through `ProductController` and WooCommerce APIs.

Managed page slug defaults live in `app/Config/pages.php`. Administrators can override them per site from **Appearance > Trang HacoLED**, save without applying, or synchronize the new slugs to existing pages. Overrides are stored in the `hacoled_managed_page_slugs` option; tracked page IDs prevent duplicates when a slug changes.

## Per-content layouts

Page, Post, Product, Job, and future post types share one universal catalog in the **Giao diện HacoLED** editor meta box. A layout can be assigned to exactly one content item globally. The selector shows the current layout and all unassigned layouts; layouts owned by another Page, Post, Product, or Job are omitted. The selected stable key is stored in `_hacoled_content_layout` and ownership is validated again on save.

To add a layout:

1. Create its presentation file under `views/`.
2. Register its stable key, label, and description once in `app/Config/layouts.php`.
3. Add a renderer: use a `controller_action` for a fully custom template flow, or a post-type implementation with `type = view`; native Page routers use `type = page_template`.
4. Select it on the individual content edit screen.

Never branch on hard-coded post or product IDs inside views or controllers.

## Page template flow

`page-templates/about.php` -> `TemplateController::about()` -> `views/pages/about.php`

This split is intentional: WordPress needs a discoverable template entry, while the MVC presentation layer belongs in `views`.

## Update checklist

1. Review WordPress and WooCommerce changelogs.
2. Check WooCommerce status for outdated template overrides.
3. Install locked frontend dependencies with `npm ci`.
4. Rebuild CSS and JavaScript.
5. Run PHP syntax checks.
6. Smoke-test homepage, search, 404, posts, product archives, product detail, cart, and checkout.
7. Deploy to the active `hacoled` theme directory.
