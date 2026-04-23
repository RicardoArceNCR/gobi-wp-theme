# AI_WORKFLOW.md — Flujo actualizado para trabajar con IA en GOBi WordPress

> Este archivo explica cómo debe colaborar una IA en el proyecto actual.
> Está actualizado a la nueva dirección WordPress-first.

---

## Propósito

Dar a una IA el contexto correcto para colaborar en el desarrollo de GOBi sin romper la arquitectura del proyecto.

La IA debe entender que GOBi ya no debe tratarse como un simple tema editorial ni como la continuación literal del stack inicial.  
Ahora el proyecto se construye como una aplicación WordPress estructurada en capas.

---

## Arquitectura que la IA debe asumir

La IA debe operar siempre bajo este modelo:

- **WordPress core** = plataforma base
- **Sage** = presentación
- **gobi-core** = dominio del producto
- **ACF Pro** = configuración editorial
- **Auth0** = identidad y login social

La IA nunca debe asumir que todo vive en el theme.

---

## Objetivo actual del proyecto

Construir una v1 sólida, nativa en WordPress, que permita:

- modelar el dominio legislativo
- tener front público claro
- habilitar curaduría editorial
- soportar login social
- preparar paneles internos futuros
- crecer sin rehacer la base técnica

---

## Estado actual que la IA debe recordar

### Ya existe
- una dirección de arquitectura bien definida
- un theme Sage útil como base visual
- un modelo de dominio previo bastante claro
- la decisión de separar negocio del theme
- la intención de usar ACF para home/editorial
- la decisión de usar Auth0 para identidad

### Aún falta
- implementar `gobi-core` como plugin real
- registrar CPTs y taxonomías del dominio
- mapear capabilities y roles
- replicar workflow de estados en WordPress
- construir bitácora propia
- montar el front público base
- cerrar la integración Auth0 en WP

---

## Instrucciones permanentes para la IA

## 1) Antes de proponer algo, clasifica la capa
La IA debe preguntar internamente:

- ¿Esto es presentación?
- ¿Esto es configuración editorial?
- ¿Esto es negocio?
- ¿Esto es identidad?
- ¿Esto debe sobrevivir si el theme cambia?

Y decidir:
- presentación → Sage
- configuración → ACF
- negocio → gobi-core
- identidad → Auth0 / integración WP
- base general → WordPress core

---

## 2) Nunca mezclar capas
La IA no debe proponer:

- negocio en Blade
- workflow en ACF
- permisos reales ocultando solo botones
- estado del proyecto como taxonomía
- bitácora importante en hacks de postmeta
- dominio en `functions.php`

---

## 3) La IA debe preservar el dominio ya definido
El proyecto previo ya aterrizó conceptos valiosos.

La IA debe respetar al menos estas entidades:

- proyecto
- diputado
- comisión
- tema
- partido
- documento
- voto
- historial / bitácora

Y estos estados:

- presentado
- en_comision
- en_debate
- votado
- aprobado
- archivado

Con transición validada y motivo obligatorio.

---

## 4) La IA debe preferir WordPress nativo y mantenible
Siempre priorizar:

- CPTs claros
- taxonomías claras
- meta bien pensada
- tabla propia cuando haga falta
- capabilities propias
- theme limpio
- plugin responsable del dominio

Evitar:
- exceso de frameworks
- headless prematuro
- capas innecesarias
- sistemas demasiado abstractos para una v1

---

## Flujo de trabajo recomendado para una IA

## Paso 1 — leer contexto base
Leer:
1. `INICIO.md`
2. `CLAUDE.md`
3. `SKILLS.md`
4. `AI_WORKFLOW.md`

## Paso 2 — identificar el tipo de tarea
La IA debe clasificar la tarea en uno de estos grupos:

### A. Arquitectura
Ejemplos:
- definir CPTs
- decidir taxonomías
- decidir tabla propia
- separar capas

### B. Plugin `gobi-core`
Ejemplos:
- bootstrap
- registro de contenido
- permissions
- transitions
- bitácora
- endpoints internos

### C. Theme Sage
Ejemplos:
- layouts
- partials
- home editorial
- listados
- templates de detalle
- composers

### D. ACF
Ejemplos:
- options page
- grupos de campos
- selección de destacados
- home modular

### E. Auth
Ejemplos:
- flujo de login
- callback
- linking de usuario
- asignación de rol

### F. Documentación
Ejemplos:
- roadmap
- contratos de arquitectura
- guías de implementación
- criterios de validación

---

## Paso 3 — responder según el tipo

### Si es arquitectura
La IA debe responder con:
- decisión
- razón
- capa correcta
- riesgo si se hace mal
- recomendación concreta

### Si es `gobi-core`
La IA debe responder con:
- estructura de carpetas
- archivos propuestos
- hooks a usar
- capabilities o tablas si aplica
- ejemplo de implementación

### Si es Sage
La IA debe responder con:
- archivo Blade o Composer
- organización por secciones
- clases o componentes
- qué datos vienen del plugin
- qué no debe vivir ahí

### Si es ACF
La IA debe responder con:
- grupo de campos
- ubicación
- uso editorial
- límites claros
- relación con el plugin o el theme

### Si es Auth0
La IA debe responder con:
- flujo exacto
- punto de integración con WP
- qué parte resuelve Auth0
- qué parte resuelve `gobi-core`

### Si es documentación
La IA debe responder con:
- texto claro
- estado real
- prioridades
- lenguaje operativo
- pasos accionables

---

## Comandos y flujo técnico habituales

### Theme Sage
```bash
composer install
npm install
npm run dev
npm run build
```

### WordPress / entorno local
La IA debe asumir que el proyecto corre en entorno local tipo LocalWP/DevKinsta o similar, y que luego será desplegado.

### Plugin propio
La IA debe favorecer una estructura simple y profesional:
```txt
wp-content/plugins/gobi-core/
├── gobi-core.php
├── includes/ o src/
├── modules/
├── uninstall.php
└── README.md
```

---

## Reglas para generar código

### En PHP / WordPress
- seguir convenciones WordPress limpias
- usar prefijos `gobi_`
- separar registro, permisos y helpers
- evitar meter todo en un solo archivo
- comentar lo justo, sin ruido

### En Blade
- mantener archivos legibles
- preferir partials
- evitar lógica pesada inline
- usar datos preparados desde composers o helpers

### En ACF
- nombres consistentes
- pensar en el editor real
- no duplicar lógica que pertenece al plugin

---

## Qué tipo de ayuda debe priorizar la IA ahora

La IA debe priorizar, en este orden:

1. estructura real de `gobi-core`
2. modelo WordPress del dominio
3. capabilities y roles
4. workflow de estados
5. bitácora
6. home editorial
7. front público
8. auth real

---

## Qué debe evitar la IA ahora

No debe distraerse con:
- optimizaciones prematuras
- features demasiado avanzadas
- microservicios
- GraphQL innecesario
- headless en v1
- automatizaciones AI complejas antes de cerrar la base
- ideas visuales si todavía falta la capa de dominio

---

## Estilo de respuesta esperado de la IA

La IA debe responder de forma:

- clara
- precisa
- quirúrgica
- accionable
- basada en capas
- orientada a implementación real

Debe decir:
- qué archivo tocar
- qué capa afecta
- por qué
- qué validar después

No debe responder de forma abstracta si la pregunta pide implementación.

---

## Pregunta guía permanente

Antes de cada propuesta, la IA debe preguntarse:

> ¿Estoy fortaleciendo la base WordPress v1 o la estoy ensuciando?

Si la ensucia, debe replantear la solución.

---

## Fórmula mental correcta para este proyecto

> WordPress hospeda.  
> Sage renderiza.  
> ACF edita.  
> Auth0 autentica.  
> gobi-core gobierna.
