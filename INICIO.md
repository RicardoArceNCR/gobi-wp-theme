# INICIO.md — GOBi WordPress v1

## Qué es GOBi

GOBi es una plataforma de inteligencia política regional, iniciando con Costa Rica, orientada a traducir actividad legislativa e institucional en información navegable, entendible y accionable.

## Arquitectura oficial

- **WordPress** → base operativa, administración, usuarios, contenido y persistencia.
- **Sage** → theme de presentación, Blade, sistema visual y assets.
- **gobi-core** → plugin del dominio: entidades, workflow, capabilities, relaciones y bitácora.
- **ACF Pro** → capa editorial configurable; no debe gobernar lógica crítica.
- **Auth0** → identidad/login social futuro; la autorización real vive en WordPress + `gobi-core`.

## Regla principal

**El dominio nunca vive en el theme.**

Sage renderiza. `gobi-core` gobierna. ACF edita/configura. Auth0 autentica. WordPress hospeda y ejecuta.

## Estado real del proyecto

### Ya está resuelto

- Theme Sage funcionando.
- Build de Vite recuperado y generando `public/build/manifest.json`.
- CSS organizado por capas: `core/`, `components/`, `sections/`, `vendors/`, `overrides/`.
- `app.css` funciona como índice de imports del sistema visual.
- `gobi-core` existe como plugin real y está activo.
- CPTs registrados: `gobi_proyecto`, `gobi_diputado`, `gobi_comision`, `gobi_pais`.
- Taxonomías registradas: `gobi_tema`, `gobi_partido`.
- Base multi-país iniciada con entidad `gobi_pais`, relación `_gobi_pais_id` y helper `Gobi\Relations\Country`.
- Capabilities iniciales creadas: `gobi_change_project_state`, `gobi_view_bitacora`, `gobi_manage_home_curation`, `gobi_edit_project_notes`, `gobi_view_private_explainers`, `gobi_view_internal_metrics`.
- Workflow base implementado con estados y transiciones.
- Tabla propia `wp_gobi_bitacora` definida en activación del plugin.
- Logger de bitácora implementado.

## Fase actual

**Fase 3 — conexión real entre dominio, administración editorial y front público.**

La fase 2.5 dejó el dominio WordPress implementado y la base multi-país iniciada. La fase 3 debe conectar ese dominio con datos semilla, vistas públicas mínimas y una ficha legislativa clara.

## Principio de producto para `gobi_proyecto`

Un proyecto legislativo no debe ser una entrada de blog ni una página simple. Debe funcionar como ficha estructurada del producto.

### Ficha mínima del proyecto

Campos propios del proyecto:

- `_gobi_pais_id`
- `_gobi_expediente`
- `_gobi_estado`
- `_gobi_fecha_inicio`
- `_gobi_resumen_ciudadano`
- `_gobi_texto_base_url`
- `_gobi_organo_presentador`
- `_gobi_comision_id`

Relaciones iniciales:

- país → `gobi_pais`
- comisión → `gobi_comision`
- temas → `gobi_tema`
- actores relacionados → `gobi_diputado`
- partidos → `gobi_partido`

## Qué no crear todavía

No crear todavía CPTs para votaciones, audiencias, videos, noticias relacionadas, notificaciones o perfil de usuario.

Esos módulos vendrán después de validar el expediente legislativo mínimo.

## Módulos futuros del detalle de proyecto

La pantalla de proyecto podrá crecer hacia documentos oficiales, audiencias, votaciones, medios de comunicación, videos, actores que apoyan o rechazan, historial público y alertas o seguimiento ciudadano.

En esta etapa deben documentarse como módulos futuros, no como campos improvisados.

## Reglas vigentes

- No usar taxonomías para workflow.
- No resolver permisos ocultando botones.
- No guardar lógica de negocio en Blade.
- No meter dominio en `functions.php`.
- No usar ACF para transiciones críticas.
- No avanzar Auth0 sin capabilities claras.
- No avanzar front final sin dominio validado.
- No crear múltiples WordPress por país antes de necesitarlo.
- No meter votaciones, audiencias o medios como campos sueltos si luego serán entidades.

## Próximo objetivo

Construir la **ficha legislativa mínima**:

1. Crear datos semilla: Costa Rica, 1 proyecto legislativo, 1 diputado, 1 comisión, 1 tema, 1 partido.
2. Agregar campos mínimos del proyecto.
3. Crear template mínimo: `single-gobi_proyecto.blade.php`.
4. Mostrar expediente, estado, país, fecha de inicio, resumen ciudadano, comisión, texto base y presentado por.
5. Validar que el theme solo consume datos del dominio.

## Frase guía

> WordPress hospeda.  
> Sage renderiza.  
> ACF edita.  
> Auth0 autentica.  
> gobi-core gobierna.
