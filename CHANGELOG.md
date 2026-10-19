# Changelog

Todos los cambios relevantes de este paquete. Formato basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.1.0/).

## [1.0.3] - 2026-10-19

### Añadido
- Etiqueta de publicación `laraflex-assets` para copiar los assets del tema a `public/vendor/caimari/laraflex-theme-plexus/...` (docroot `public/`).
- `favicon.ico` del tema (letra «L»).
- `CHANGELOG.md` y README con requisitos e instrucciones de instalación.

### Cambiado
- Compatible con PHP 8: `php` pasa a `^7.3|^8.0`.
- Declarada la dependencia `caimari/laraflex ^1.0`, que el tema usa (modelos, controladores) y antes no figuraba.
- Añadida la licencia MIT a `composer.json` y eliminado el campo `version` (la versión sale de las etiquetas git).

### Rendimiento
- Los *view composers* de posts y páginas se calculan una sola vez por petición, en lugar de una vez por cada vista renderizada.
- Vistas totales y únicas calculadas en la propia consulta (`withSum` / `withCount`), sin N+1.

## [1.0.2] - 2026-03-28

### Añadido
- Vistas de autenticación de socios, cookies, fragmentos de código y mejoras de interfaz.

## [1.0.1] - 2023-07-06

### Añadido
- Primera versión publicada del tema Plexus.
