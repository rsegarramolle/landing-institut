# Landing gestionable – Institut

Landing page per a un centre educatiu, desenvolupada amb **PHP 8 (POO)**, **MySQL** i **Nginx**, amb Docker Compose per desplegar l’entorn.

## Contingut

- **Landing pública**: hero, sobre nosaltres, oferta educativa, contacte (dades i xarxes socials).
- **Panell d’administració**: edició de seccions, oferta educativa i configuració general (nom del centre, adreça, telèfon, email, xarxes).
- **Base de dades**: seccions, blocs, oferta educativa, config, usuaris.

## Requisits

- Docker i Docker Compose
- (Opcional) Composer per generar l’autoload localment

## Posada en marxa

1. **Clonar o copiar el projecte** i anar a la carpeta:

   ```bash
   cd landing-institut
   ```

2. **Instal·lar dependències PHP (autoload)** dins del contenidor:

   ```bash
   docker compose run --rm php composer install --no-dev
   ```

   Si teniu Composer al vostre ordinador:

   ```bash
   cd www && composer install --no-dev && cd ..
   ```

3. **Pujar els serveis**:

   ```bash
   docker compose up -d
   ```

4. **Obrir al navegador**:
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
│   └── vendor/            # Després de composer install
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
