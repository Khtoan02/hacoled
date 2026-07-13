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
- `app/Models`: normalized read access to WordPress and WooCommerce data.
- `app/Repositories`: query collections used by controllers and catalog pages.
- `app/Support`: native WordPress hooks and compatibility callbacks.
- `views/pages`: complete page views.
- `views/common`: shared WordPress archive, page, and single views.
- `views/components`: reusable UI fragments.
- `views/catalog`: controller-owned shop, taxonomy, and product page views.
- `woocommerce`: WooCommerce template overrides only.
- `page-templates`: selectable custom WordPress page templates.
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
- `page-templates/*`: templates selected explicitly in the WordPress page editor.
- Root `template-*.php` files are compatibility routers for assignments created before this structure; do not add new template headers to them.
- Product templates route through `ProductController` and WooCommerce APIs.

## Update checklist

1. Review WordPress and WooCommerce changelogs.
2. Check WooCommerce status for outdated template overrides.
3. Install locked frontend dependencies with `npm ci`.
4. Rebuild CSS and JavaScript.
5. Run PHP syntax checks.
6. Smoke-test homepage, search, 404, posts, product archives, product detail, cart, and checkout.
7. Deploy to the active `hacoled` theme directory.
