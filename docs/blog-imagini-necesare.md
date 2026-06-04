# Imagini blog — status

**Rezolvat (2026-06-05):** toate cele 10 imagini există în `public/images/blog/{slug}.webp` + `.jpg`
(1254×705, 16:9), generate cu Gemini (nano-banana) după conceptele de mai jos — fără persoane,
fără text — și atașate automat de `ArticolSeeder` la seed.

Dacă vrei să înlocuiești o imagine: pune noul fișier peste `public/images/blog/{slug}.webp`
(+ varianta `.jpg` pentru fallback `<picture>`) — nu e nevoie de re-seed, path-ul e deja în DB.

| Slug | Concept imagine |
|---|---|
| `lemn-uscat-vs-lemn-verde-cum-recunosti` | Lemne crăpate și stivuite, câteva bucăți verificate la capăt, fundal natural |
| `cum-depozitezi-corect-lemnul-de-foc` | Stivă ordonată de lemne sub șopron aerisit, lumină naturală |
| `lemn-de-foc-paletizat-sau-vrac` | Palet/lăzi cu lemn de foc tăiat și crăpat, fundal rural curat |
| `acte-cumparare-lemn-de-foc-aviz-factura-sumal` | Camion cu lemn de foc și documente/aviz pe clipboard, fără date personale |
| `transport-lemn-aviz-sumal-ce-trebuie-sa-stii` | Autospecială forestieră încărcată cu bușteni, drum forestier, fără persoane |
| `cum-alegi-firma-serioasa-exploatare-forestiera` | Harvester și forwarder într-o pădure, lumină naturală, fără persoane identificabile |
| `harvester-forwarder-utilaje-moderne-padure` | Harvester lucrând în pădure și forwarder cu bușteni, look editorial |
| `de-ce-conteaza-rariturile-si-curatirile-in-padure` | Arboret tânăr cu lumină naturală, arbori selectați, utilaj la distanță |
| `scos-cioate-metode-utilaje-cand-este-necesar` | Excavator lângă o cioată mare, teren curățat, fără persoane |
| `defrisare-teren-pentru-constructie-pasi-verificari` | Teren curățat parțial, utilaj la distanță, sat la orizont, fără persoane |

> Politica foto (roadmap F6): fără persoane identificabile în cadre.
