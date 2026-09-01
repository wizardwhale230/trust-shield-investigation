# Plan: Law-Firm Color Refresh

## TL;DR
Replace the current bright-blue brand palette (`#0B5FFF`) with a classic
law-firm "Navy + Gold" palette across the three shared Tailwind CDN configs
in `resources/views/layouts/`. White background and semantic token names
(`primary`, `accent`, `surface`, `content`, `border`, status colors) stay
identical, so every Blade view that uses `bg-primary` / `text-primary` /
`bg-primary-light` / `bg-primary-dark` automatically picks up the new look —
no per-view edits required.

## Proposed Palette (Navy + Gold, white bg)

- `primary.light`   `#E6EAF2`  — hover/tinted backgrounds, active nav row
- `primary.DEFAULT` `#0A1F44`  — buttons, links, headings, brand bar
- `primary.dark`    `#061634`  — hover/pressed state for primary

- `accent.light`    `#F6EFE0`  — subtle gold tints, callout backgrounds
- `accent.DEFAULT`  `#B08D57`  — secondary CTAs, highlights, dividers, badges
- `accent.dark`     `#8A6C3E`  — hover state for accent

- `content.DEFAULT`   `#0F172A` (slate-900) — body text (slightly warmer than current)
- `content.secondary` `#475569`
- `content.tertiary`  `#94A3B8`
- `content.inverse`   `#FFFFFF`

- `surface.DEFAULT` `#FFFFFF`  (unchanged — white background preserved)
- `surface.muted`   `#F7F8FB`  (very subtle cool gray)
- `surface.subtle`  `#EEF1F6`

- `border.DEFAULT`  `#E2E6EE`
- `border.muted`    `#EDF0F5`

Status colors stay as-is (`success #16A34A`, `warning #D97706`,
`danger #DC2626`, `info #2563EB`) — user opted "layouts only".

Optional addition (consistent across layouts): introduce an `accent` token
in all three configs even though the existing layouts don't currently
declare one. This unlocks future use of `bg-accent`/`text-accent` for
gold accents (seal/scales-of-justice motifs, hero underlines, etc.) without
forcing new edits later. No existing class names are removed.

## Files to Modify (3 files, all in `resources/views/layouts/`)

1. [resources/views/layouts/dashboard.blade.php](resources/views/layouts/dashboard.blade.php#L15-L70)
   — replace the `tailwind.config` `colors` block (lines ~18-58). Updates
   user dashboard, sidebar nav (`.nav-link-active` uses `bg-primary-light`
   `text-primary`), KPI cards, buttons, table headers.

2. [resources/views/layouts/recovery.blade.php](resources/views/layouts/recovery.blade.php#L24-L60)
   — replace the same `colors` block (lines ~27-50). Updates the public
   recovery / claims marketing site, hero CTAs, link colors, prose anchors.

3. [resources/views/layouts/auth.blade.php](resources/views/layouts/auth.blade.php#L15-L57)
   — replace the same `colors` block (lines ~18-46). Updates login,
   register, password reset, 2FA screens, including `alert-info` border.

For each file:
- Swap the three `primary.*` hex values to the navy set.
- Add the new `accent` color group (light/DEFAULT/dark).
- Tweak `content`, `surface`, `border` hexes to the warmer/softer values
  above so cards and text harmonize with navy (still effectively white).
- Leave `fontFamily`, `boxShadow`, status colors, all `@layer components`
  rules, and every Blade markup line untouched.

## Steps

1. Update [resources/views/layouts/dashboard.blade.php](resources/views/layouts/dashboard.blade.php) color block.
2. Update [resources/views/layouts/recovery.blade.php](resources/views/layouts/recovery.blade.php) color block.
3. Update [resources/views/layouts/auth.blade.php](resources/views/layouts/auth.blade.php) color block.
4. Run `php artisan view:clear` to flush compiled Blade cache.

Steps 1–3 are independent and can run in parallel.

## Verification

1. Hard-reload the public recovery homepage — header, hero CTA, primary
   buttons, link hovers, footer links should all be navy with gold accent
   touches available via `bg-accent`.
2. Log in and visit `/dashboard` — sidebar active row, KPI icon
   backgrounds, "View All" links, and `.btn-primary` should be navy.
   Status badges (success/warning/info) must remain unchanged.
3. Visit `/login`, `/register`, `/forgot-password` — primary submit
   button, focus ring, and `alert-info` left border should be navy.
4. Visual sweep of a case-detail page to confirm no element still looks
   bright blue (would indicate a hard-coded `#0B5FFF` somewhere — grep
   confirms none currently exist outside the three layout configs).
5. Check contrast: navy `#0A1F44` on white = ~14.5:1 (AAA), gold
   `#B08D57` on white = ~3.6:1 (use only for large text / decorative,
   not body copy — the plan reserves it for accents/CTAs only).

## Decisions

- **Palette**: Navy + Gold (classic) — chosen by user.
- **Scope**: Layouts only (3 files) — chosen by user. Charts in
  `dash/`, email templates, and status semantics are deliberately
  excluded from this pass.
- **Background**: stays white per user instruction.
- **Semantic token names** unchanged — zero risk of breaking existing
  Blade views or `@apply` rules.
- **No class renames, no markup edits, no new files.**

## Hard Constraints (enforced on every edit)

- **Only semantic classes**: `bg-primary`, `bg-primary-light`, `bg-primary-dark`, `text-primary`, `bg-accent`, `text-accent`, `bg-surface`, `bg-surface-muted`, `bg-surface-subtle`, `text-content`, `text-content-secondary`, `text-content-tertiary`, `border-border`, `border-border-muted`, `bg-success`, `bg-warning`, `bg-danger`, `bg-info` (and their `-light` variants).
- **NO inline hex** anywhere in Blade markup or `@apply` rules. Hex values appear ONLY inside the `tailwind.config` color declaration blocks in the 3 layout files (the single source of truth).
- **NO arbitrary values** — `bg-[#xxx]`, `text-[#xxx]`, `border-[#xxx]`, `w-[123px]`, `style="color:..."` are all banned.
- **NO AI-slop colors** — no `purple-*`, `pink-*`, `indigo-*`, `fuchsia-*`, `violet-*`, `rose-*` Tailwind defaults anywhere.
- **Minimal gradients** — reserved for at most one hero accent if explicitly approved later; default is solid `bg-primary` / `bg-surface`.
- **Validation gate**: before finishing, run grep across `resources/views/**/*.blade.php` for `#[0-9A-Fa-f]{3,6}`, `bg-\[`, `text-\[`, `border-\[`, `purple-|pink-|indigo-|violet-|fuchsia-|rose-`, and `gradient-to-` to confirm zero new violations are introduced. Pre-existing violations outside the 3 layout files are out of scope.

## Out of Scope

- Pre-compiled assets in `dash/` and `temp/custom/` (legacy Bootstrap 3
  styling for older admin pages).
- Chart.js / ApexCharts color arrays embedded in JS bundles.
- Email/notification templates under `app/Mail/` and
  `resources/views/mail/`.
- Admin panel views that still rely on the legacy theme.
