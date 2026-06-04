# Checklist lansare — galle-silva.com (verificare manuala pe live)

> De bifat de mana in browser dupa deploy (vezi `DEPLOY-CPANEL.md` pentru pasii de instalare).
> Verificarile automate (cod, traduceri, teste) au fost facute local — aici e DOAR ce nu se
> poate verifica decat pe serverul live.

## Functional de baza

- [ ] Homepage `https://galle-silva.com` se incarca fara erori; CSS/JS ok, fara „mixed content" in consola.
- [ ] `http://galle-silva.com` → redirect 301 la `https://galle-silva.com`.
- [ ] `https://www.galle-silva.com` → redirect 301 la `https://galle-silva.com` (fara www).
- [ ] Paginile cheie merg: `/servicii` (+ cele 5 subpagini), `/lemn-de-foc` (+ o pagina de localitate,
      ex. `/lemn-de-foc/ploiesti`), `/despre`, `/certificari`, `/intrebari-frecvente`, `/blog`
      (+ un articol), `/proiecte` (+ un proiect), `/contact`, `/termeni`, `/confidentialitate`,
      `/cookies`, `/date-firma`.
- [ ] `/de` si `/en` merg; switcher-ul de limba pastreaza pagina curenta (ex. de pe `/despre` ajungi pe `/de/despre`).
- [ ] Pozele se afiseaza peste tot (inclusiv galeria de proiecte si pozele echipei — necesita
      `storage:link`, pasul 7 din ghid).

## Formulare + email (SMTP real)

- [ ] Formularul de contact trimite; **emailul ajunge** in inboxul `info@galle-silva.com`.
- [ ] Comanda de lemn de foc (formularul din `/lemn-de-foc`) se salveaza (apare in `/admin`)
      si soseste notificarea pe email (coada ruleaza prin cron — pana la ~1 min intarziere).
- [ ] Cookie consent (banner opt-in) apare la prima vizita si retine alegerea.

## Admin

- [ ] `/admin/login` functioneaza cu userul admin din seed. **Schimba parola imediat dupa primul login.**
- [ ] O poza urcata din admin (ex. la un proiect) se afiseaza pe site (confirma `storage:link`).

## SEO / fisiere publice

- [ ] `https://galle-silva.com/sitemap.xml` — accesibil, URL-urile incep cu `https://galle-silva.com`.
- [ ] `https://galle-silva.com/robots.txt` — accesibil, sitemap-ul pe `.com`.
- [ ] `https://galle-silva.com/llms.txt` — accesibil.
- [ ] Canonical + hreflang in sursa paginilor folosesc `https://galle-silva.com` (nu localhost/http).

## Securitate (CRITIC)

- [ ] `https://galle-silva.com/.env` → **404/403** (doc-root e pe `public/`, deci nu trebuie sa fie accesibil).
- [ ] Dupa setup: `.env` are `DEPLOY_OPS_ENABLED=false` + `DEPLOY_SECRET` schimbat (string lung aleator),
      apoi config-cache reincarcat.
- [ ] Verifica: `https://galle-silva.com/__ops/migrate-fresh-seed?secret=waddone11` → **404**.
- [ ] Verifica: `https://galle-silva.com/__ops/cache-clear?secret=waddone11` → **404**.
- [ ] Parola adminului schimbata (cea din seed e cunoscuta/slaba).

## Infrastructura

- [ ] Cron in KAS (PHP **8.4** CLI) la 1 minut: `artisan schedule:run` (vezi ghid pasul 8).
      Verificare: a doua zi, `lastmod` din `/sitemap.xml` s-a actualizat (ruleaza zilnic).
- [ ] Let's Encrypt activ pentru `galle-silva.com` + `www.galle-silva.com`, cu re-emitere automata.

## Optional (recomandat in prima saptamana)

- [ ] Google Search Console: adauga proprietatea + trimite `sitemap.xml`; verifica indexarea.
- [ ] Test real de pe mobil (3G/4G): viteza + layout pe paginile cheie.
- [ ] Confirma cu contabilul flag-ul TVA (`COMPANY_VAT`) — daca firma e platitoare, pune `true`
      in `.env` (afiseaza automat `RO52771440`) + config-cache.
