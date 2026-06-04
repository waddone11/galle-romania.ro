# Poze necesare — echipa (/despre)

Echipa de pe `/despre` vine din modelul `Membru` (admin → Continut → Echipa). Membrii sunt
seed-uiti **fara poze** — blocul `echipa` afiseaza un avatar cu initiale pana se incarca
fotografia din admin (Filament → Echipa → editeaza membrul → campul „Poza").

Recomandari: portret, incadrare patrata (se afiseaza rotund), minim 400x400px, fundal
neutru/exterior, lumina naturala. Pozele urcate din admin ajung in `storage/app/public/membri/`
(vezi nota de deploy din README — directorul trebuie persistat intre deploy-uri).

| Membru | Rol | Status poza |
|---|---|---|
| Răzvan Solzaru | Manager general | lipsa — de incarcat din admin |
| Ion Narcis Marin | Manager operațiuni | lipsa — de incarcat din admin |
| Dragici Dumitru | Operator harvester | lipsa — de incarcat din admin |
| Roată Alexandru | Muncitor în silvicultură | lipsa — de incarcat din admin |

> Nota: pozele de echipa sunt portrete voluntare — exceptie de la politica „fara persoane
> identificabile" (aceea se aplica pozelor de lucrari/blog). Cere acordul fiecarui membru.

Pentru imaginile de blog vezi [blog-imagini-necesare.md](blog-imagini-necesare.md).
