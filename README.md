# Landing gestionable – Institut (Ús educatiu)

Landing page per a un centre educatiu, desenvolupada amb **PHP 8 (POO)**, **MySQL** i **Nginx**, amb Docker Compose per desplegar l’entorn.

## Contingut

- **Landing pública**: hero, sobre nosaltres, oferta educativa, contacte (dades i xarxes socials).
- **Panell d’administració**: edició de seccions, oferta educativa i configuració general (nom del centre, adreça, telèfon, email, xarxes).
- **Base de dades**: seccions, blocs, oferta educativa, config, usuaris.

## Requisits

- Docker i Docker Compose
- (Opcional) Composer per generar l’autoload localment

## Pujar el projecte a GitHub

El repositori Git ja està inicialitzat i el primer commit està fet. Per pujar-lo a GitHub:

1. Crea un **repositori nou** a [github.com/new](https://github.com/new) (nom recomanat: `landing-institut`). No afegueu README ni .gitignore; el projecte ja en té.

2. Enllaça el repositori remot i puja les canvis (substitueix `EL_TEU_USUARI` pel teu usuari de GitHub):

   ```bash
   cd landing-institut
   git remote add origin https://github.com/rsegarramolle/landing-institut.git
   git branch -M main
   git push -u origin main
   ```

   Repositori: [github.com/rsegarramolle/landing-institut](https://github.com/rsegarramolle/landing-institut)

## Posada en marxa

1. **Clonar el projecte** i anar a la carpeta:

   ```bash
   git clone https://github.com/rsegarramolle/landing-institut.git
   cd landing-institut
   ```

2. **Pujar els serveis** (el repositori inclou `vendor/`, no cal executar `composer install`):

   ```bash
   docker compose up -d
   ```

3. **Obrir al navegador**:
   - Landing: [http://localhost:8080](http://localhost:8080)
   - Admin: [http://localhost:8080/admin](http://localhost:8080/admin)

### Els meus canvis no es veuen al contenidor

- **Executeu sempre Docker des de la carpeta del projecte** (`landing-institut`), on hi ha el `docker-compose.yml`. El volum `./www` és relatiu a aquesta carpeta; si executeu des d'una altra, es munta una carpeta equivocada.
- S'ha afegit `docker/php/php-dev.ini` perquè PHP (OPcache) comprovi els fitxers en cada petició. Si abans ja teníeu els contenidors en marxa, reinicieu el servei PHP: `docker compose restart php`

## Accés al panell d’administració

- **URL**: `/admin` (redirigeix a `/admin/login` si no esteu autenticats).
- **Usuari per defecte**: `admin@institut.cat`
- **Contrasenya per defecte**: `password`

**Important**: canvieu la contrasenya en producció (per exemple mitjançant un script que faci `UPDATE usuaris SET password = ? WHERE email = 'admin@institut.cat'` amb un hash generat amb `password_hash('nova_contrasenya', PASSWORD_DEFAULT)`).

## Estructura del projecte

```
landing-institut/
├── docker-compose.yml      # Nginx, PHP-FPM, MySQL
├── docker/
│   ├── nginx/
│   │   └── default.conf
│   ├── php/
│   │   └── Dockerfile
│   └── mysql/
│       └── init.sql       # Esquema i dades inicials
├── www/
│   ├── config/
│   │   └── config.php     # Configuració (DB, etc.)
│   ├── public/            # Document root
│   │   ├── index.php      # Front controller
│   │   ├── css/
│   │   └── js/
│   ├── src/               # PHP POO
│   │   ├── Database.php
│   │   ├── Controllers/
│   │   └── Models/
│   ├── views/
│   │   ├── landing/
│   │   └── admin/
│   ├── uploads/
│   ├── composer.json
│   └── vendor/            # Inclòs al repo; opcional: composer install per actualitzar
└── README.md
```

## Serveis Docker

| Servei | Port | Descripció |
|--------|------|------------|
| Nginx  | 8080 | Servidor web (arrel → `www/public`) |
| PHP-FPM| -    | Executa PHP |
| MySQL  | 3306 | Base de dades `landing_institut` |

Credencials MySQL (per connexions externes o scripts):

- **Base de dades**: `landing_institut`
- **Usuari**: `landing_user`
- **Contrasenya**: `landing_secret`
- **Root**: `root_secret`

## Tecnologies

- **PHP 8.2** amb tipat estricte i POO (classes per a Database, Models, Controllers).
- **MySQL 8**: taules `seccions`, `blocs`, `oferta_educativa`, `config`, `usuaris`.
- **Nginx**: proxy a PHP-FPM, arrel en `public/`.

## Llicència

Projecte d’exemple per a ús educatiu o intern del centre.
