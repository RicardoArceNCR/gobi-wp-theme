# CLAUDE.md — Contrato permanente del agente para GOBi WordPress

> Este archivo contiene reglas que no deben romperse.
> Si una instrucción puntual contradice estas reglas, prioriza la separación de capas y la integridad del dominio.

---

## Identidad del proyecto

GOBi es una plataforma de inteligencia política para Costa Rica.

Arquitectura objetivo:

- **WordPress core** como base
- **Sage** como theme de presentación
- **gobi-core** como plugin del dominio
- **ACF Pro** como capa editorial
- **Auth0** como capa de identidad

---

## Regla máxima

> **El dominio nunca vive en el theme.**

Por lo tanto:

- Sage presenta
- gobi-core decide
- ACF configura
- Auth0 autentica
- WordPress hospeda y ejecuta

---

## Separación de capas obligatoria

## 1) WordPress core
Responsabilidad:
- usuarios
- roles base
- media
- panel admin
- contenido editorial general
- ecosistema de plugins

Nunca usar WordPress core “pelado” como sustituto de `gobi-core`.

---

## 2) Sage (theme)
Responsabilidad:
- Blade layouts
- sections / partials
- sistema de estilos CSS estructurado
- view composers
- theme.json
- render de front y back visual
- tokens globales de diseño
- componentes visuales compartidos
- compatibilidad visual con WordPress

Sage:
- sí muestra datos
- sí consume helpers del plugin
- sí aplica UI condicional por capability
- sí define el lenguaje visual global del proyecto
- sí provee componentes reutilizables
- sí asegura consistencia visual

Sage:
- no define workflow
- no registra reglas de negocio
- no asigna roles del producto
- no implementa bitácora como sistema principal
- no guarda estado crítico del producto
- no mezcla dominio con presentación
- no crea estilos improvisados por página sin sistema
- no depende de overrides caóticos
- no resuelve cada pantalla con clases nuevas sin criterio

---

## 3) gobi-core (plugin)
Responsabilidad:
- CPTs del dominio
- taxonomías del dominio
- capabilities propias
- roles del producto
- estados y transiciones
- bitácora
- endpoints internos
- sincronización futura
- reglas de autorización del negocio
- queries complejas del dominio

Todo lo que siga siendo producto aunque cambies de theme, va aquí.

---

## 4) ACF Pro
Responsabilidad:
- options pages
- portada curada
- módulos manuales
- banners / CTAs
- relaciones editoriales
- campos configurables de presentación
- bloques editoriales

ACF no es motor de negocio.

No usar ACF para:
- workflow de estados
- autorización
- bitácora principal
- reglas críticas del sistema
- transiciones válidas

---

## 5) Auth0
Responsabilidad:
- login social
- OAuth
- Universal Login
- linking de identidades
- passwordless / SSO si aplica

Auth0 no decide permisos del producto.
Eso lo hace `gobi-core` dentro de WordPress.

---

## Regla sobre estados

El estado de un proyecto legislativo es **workflow**, no taxonomía.

Estados válidos actuales:

- `presentado`
- `en_comision`
- `en_debate`
- `votado`
- `aprobado`
- `archivado`

Transiciones válidas actuales:

- presentado → en_comision | archivado
- en_comision → en_debate | archivado
- en_debate → votado | archivado
- votado → aprobado | archivado
- aprobado → ninguna
- archivado → ninguna

Toda transición:
- exige motivo
- debe validarse
- debe registrarse en bitácora

---

## Regla sobre bitácora

La bitácora del dominio no debe resolverse como parche en `postmeta` si va a ser parte importante del producto.

Preferencia operativa:
- tabla propia en DB para historial de acciones

Campos esperados:
- entidad
- entidad_id
- acción
- campo_modificado
- valor_anterior
- valor_nuevo
- motivo
- usuario
- fecha

---

## Regla sobre capabilities

Las capabilities del producto deben ser propias, explícitas y legibles.

Ejemplos válidos:

- `gobi_view_private_explainers`
- `gobi_change_project_state`
- `gobi_edit_project_notes`
- `gobi_view_internal_metrics`
- `gobi_manage_home_curation`
- `gobi_view_bitacora`

Nunca depender solo de roles nativos sin mapear capabilities del producto.

---

## Regla sobre roles

Los roles WordPress pueden servir como base, pero el modelo del producto debe expresarse por capabilities.

Ejemplo conceptual:
- ciudadano
- editor_gobi
- curador_gobi
- admin_gobi

La UI puede leer capacidades con `current_user_can(...)`, pero la regla real vive en el plugin.

---

## Flujo de autenticación esperado

1. usuario llega al sitio
2. hace clic en iniciar sesión
3. Auth0 muestra Universal Login
4. el usuario se autentica con proveedor social o corporativo
5. WordPress crea o vincula el usuario
6. `gobi-core` asigna rol / capabilities
7. Sage renderiza la UI correcta

Nunca confundir autenticación con autorización.

---

## Reglas de implementación

## En Blade
Sí:
- markup
- composición visual
- condicionales leves de render
- llamadas simples a helpers o composers

No:
- lógica de negocio compleja
- consultas pesadas improvisadas
- reglas de transición
- decisiones de autorización central

---

## En functions.php o setup.php
Sí:
- boot del theme
- registro de assets
- soporte del theme
- menús
- widgets
- view / editor setup

No:
- dominio del producto
- reglas del workflow
- endpoints de negocio
- sistema de permisos del producto

---

## En ACF
Sí:
- portada editorial
- selección manual de destacados
- campos visuales
- configuración de módulos

No:
- workflow
- bitácora
- permisos
- reglas de estado

---

## En gobi-core
Sí:
- todo lo que seguiría existiendo aunque cambies de theme
- todo lo que exija integridad del dominio
- todo lo que requiera trazabilidad
- todo lo que sea autorización real

---

## Convenciones de trabajo

### Nombres
- plugin del dominio: `gobi-core`
- prefijos recomendados:
  - `gobi_` para CPTs y taxonomías
  - `gobi_` para funciones propias
  - `gobi_` para capabilities
  - `wp_gobi_` para tablas propias

### CPTs iniciales esperados
- `gobi_proyecto`
- `gobi_diputado`
- `gobi_comision`
- `gobi_alerta` (si termina mereciendo entidad propia)

### Taxonomías iniciales esperadas
- `gobi_tema`
- `gobi_partido`

---

## Criterio de calidad del proyecto

Una solución es correcta si cumple estas condiciones:

1. no mezcla capas
2. no compromete portabilidad
3. no mete negocio en el theme
4. no convierte ACF en backend
5. permite iterar front sin romper dominio
6. permite cambiar dominio sin reescribir todo el front
7. deja espacio para paneles internos futuros

---

## Lo que nunca debe proponer una IA en este proyecto

- "hagamos toda la lógica en Blade"
- "usemos ACF para controlar estados"
- "usemos taxonomías para workflow"
- "guardemos toda la bitácora en postmeta sin criterio"
- "resolvamos permisos solo ocultando botones"
- "metamos dominio en `functions.php`"
- "dejemos el plugin para después"
- "hagamos headless desde ya aunque retrase la v1"
- "usemos CSS improvisado por página sin sistema"
- "mezclemos tokens con hacks visuales"
- "dependamos de overrides caóticos para resolver todo"
- "usemos el CSS como parche constante"

---

## Prioridad actual del proyecto

Orden recomendado de trabajo:

1. `gobi-core` base
2. CPTs + taxonomías
3. capabilities + roles
4. estado + transiciones + bitácora
5. home editorial con ACF
6. vistas públicas con Sage
7. Auth0 real
8. paneles internos

---

## Al generar código o guía

Siempre:
- indicar en qué capa vive cada cosa
- proteger la separación entre theme y plugin
- preferir sencillez mantenible
- documentar decisiones irreversibles
- pensar en WordPress real, no en demo

Si hay ambigüedad, elegir la opción que conserve mejor la arquitectura.
