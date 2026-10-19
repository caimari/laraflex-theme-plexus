# Tema Plexus para LaraFlex CMS & CRUD Toolkit

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Tema público "Plexus" para [LaraFlex](https://github.com/caimari/laraflex). Aporta el diseño de la web (portada, blog, páginas, categorías, tags, galerías y vistas de acceso de socios).

## Requisitos

| | Versión |
|---|---|
| PHP | 7.3 o superior, incluido PHP 8.x (probado en PHP 8.3) |
| Laravel | **8.x** |
| Paquetes | `caimari/laraflex` (se instala automáticamente como dependencia) |

## Instalación

En la raíz de un proyecto Laravel 8 (consulta las instrucciones completas en el README de [LaraFlex](https://github.com/caimari/laraflex)):

```bash
composer require caimari/laraflex-theme-plexus

php artisan migrate
php artisan vendor:publish --tag=laraflex-assets
```

`laraflex-assets` copia los estilos, scripts e imágenes del tema a `public/vendor/caimari/laraflex-theme-plexus/...`. Es imprescindible cuando el docroot del servidor es `public/` (lo normal en Laravel). Tras una actualización, vuelve a ejecutarlo con `--force`.

Comenta o elimina la ruta de bienvenida de `routes/web.php` para que el tema pueda servir la raíz (`/`).

## Historial de cambios

Consulta [CHANGELOG.md](CHANGELOG.md).
