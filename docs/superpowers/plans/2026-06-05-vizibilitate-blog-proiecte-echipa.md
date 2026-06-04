# Vizibilitate blog + proiecte, imagini proiecte, echipa cu poze — Implementation Plan

> **For agentic workers:** Executed inline in-session (user instructed: no checkpoints, decide alone, push to main). Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Surface Blog & Proiecte (nav dropdown + footer + home teasers), wire the Proiect `galerie` medialibrary collection end-to-end (admin upload, views, seeded photos), and convert the team into a manageable `Membru` model with photos rendered by a new `echipa` CMS block on /despre.

**Architecture:** Follow existing patterns 1:1 — self-querying blade blocks (like `blocks/certificari`), Filament v5 resource layout (`Resources/<Plural>/{Resource,Pages,Schemas,Tables}`), `HasTranslatableTabs`, `updateOrCreate` seeders. Media via spatie/laravel-medialibrary (already installed) + `filament/spatie-laravel-media-library-plugin` (new dev-time composer dep, runtime).

**Tech Stack:** Laravel 13, Filament 5.6, Livewire 4, spatie medialibrary 11, Tailwind 4/Vite, Pest 4, PHPStan lvl 5, Pint. All commands via `docker compose exec laravel.test`.

---

### Task 1: Navbar dropdown „Resurse" + footer Blog link

**Files:**
- Modify: `resources/views/components/site-navbar.blade.php`
- Modify: `resources/views/components/site-footer.blade.php`

- [ ] Desktop nav: primaries Acasa, Servicii, Lemn de foc, Despre, Contact + dropdown **Resurse** (Proiecte, Blog, Certificari, Intrebari frecvente) — Alpine `x-data` dropdown with `@click.outside`, chevron, `$prefix` locale-aware links. Certificari moves from top level into the dropdown (8 items flat would crowd the bar).
- [ ] Mobile menu: same items, Resurse group rendered flat under a small uppercase label.
- [ ] Footer „Companie" column: add Blog (and Intrebari frecvente) next to existing Proiecte.

### Task 2: Proiect galerie (medialibrary) — admin, views, seed

**Files:**
- Modify: `composer.json` (require `filament/spatie-laravel-media-library-plugin:^5.6` — run in container)
- Modify: `app/Models/Proiect.php` (conversions `card` ~800x450 crop, `mare` ~1600 max, nonQueued)
- Modify: `app/Filament/Resources/Proiects/Schemas/ProiectForm.php` (Section „Galerie" cu SpatieMediaLibraryFileUpload multiple/reorderable/image)
- Modify: `resources/views/site/proiecte.blade.php` (cover = first media `card` conversion, fallback elegant placeholder)
- Modify: `resources/views/site/proiect.blade.php` (grid galerie completa, lazy, width/height anti-CLS, fallback placeholder)
- Modify: `database/seeders/ProiectSeeder.php` (idempotent: if `getMedia('galerie')` empty → `addMedia(public_path(...))->preservingOriginal()->toMediaCollection('galerie')`, 2–3 poze tematice per proiect din `public/images/galle/proiecte/*.jpg`)

### Task 3: Home teasers — blocks `proiecte_recente` + `blog_recent`

**Files:**
- Create: `resources/views/blocks/proiecte_recente.blade.php` (self-query: 3 proiecte publicate, cover medialibrary, titlu + locatie/an, link „Vezi toate proiectele" → `$prefix/proiecte`)
- Create: `resources/views/blocks/blog_recent.blade.php` (self-query: 3 articole publicate desc published_at, imagine + titlu + excerpt, link „Vezi blogul" → `$prefix/blog`)
- Modify: `app/Filament/Resources/Paginas/Schemas/PaginaForm.php` (register both blocks: eyebrow/titlu/link_text translatable)
- Modify: `database/seeders/PaginaSeeder.php` home: `proiecte_recente` dupa `galerie`, `blog_recent` inainte de `cta` (texte RO; DE/EN null)

### Task 4: Membru + bloc `echipa` pe /despre

**Files:**
- Create: `database/migrations/2026_06_05_110000_create_membri_table.php` (nume string, rol json, imagine string nullable, ordine uint, is_active bool, index [is_active, ordine])
- Create: `app/Models/Membru.php` (HasTranslations [rol], HasFactory)
- Create: `database/factories/MembruFactory.php`
- Create: `database/seeders/MembruSeeder.php` (4 membri, rol RO+DE+EN preluate din blocul carduri existent — nu regresam DE/EN; fara poze) + register in `DatabaseSeeder` (inainte de PaginaSeeder)
- Create: `app/Filament/Resources/Membrus/{MembruResource,Pages/*,Schemas/MembruForm,Tables/MembrusTable}.php` (grup Continut, sort 45, FileUpload imagine disk public directory `membri`)
- Create: `resources/views/blocks/echipa.blade.php` (self-query membri activi ordonati; foto rotunda sau avatar cu initiale fallback; suporta path `/...` sau storage relative)
- Modify: `app/Filament/Resources/Paginas/Schemas/PaginaForm.php` (block `echipa`: eyebrow/titlu translatable)
- Modify: `database/seeders/PaginaSeeder.php` despre: blocul `carduri` (echipa) → bloc `echipa` (carduri de pe home NEATINS)
- Create: `docs/poze-necesare.md` (lista poze echipa de incarcat din admin)

### Task 5: Tests, QA gates, build, README, push

**Files:**
- Create: `tests/Feature/VizibilitateContinutTest.php`
- Modify: `README.md` (nota deploy ALL-INKL: `storage:link` + persista `storage/app/public`; structura nav)

- [ ] Tests: nav are link blog+proiecte; home are teaser proiecte + teaser blog; `/proiecte` randeaza imagini medialibrary (nu placeholder); MembruSeeder + `/despre` randeaza echipa cu nume+rol.
- [ ] `docker compose exec laravel.test php artisan migrate:fresh --seed` curat.
- [ ] `npm run build` (clase Tailwind noi in blade-uri).
- [ ] Pint + PHPStan lvl 5 + Pest — toate verzi, apoi commit + push pe main.
