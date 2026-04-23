# SKILLS.md — Guía quirúrgica de trabajo para GOBi WordPress

> Este archivo describe cómo debe trabajar una IA o un colaborador técnico dentro del proyecto.
> No reemplaza `INICIO.md` ni `CLAUDE.md`; los complementa.

---

## Objetivo de estas skills

Asegurar que cada intervención en el proyecto:

- responda al estado real actual
- respete la arquitectura WordPress-first
- evite deuda técnica innecesaria
- mantenga el dominio limpio y portable
- ayude a construir una v1 sólida

---

## Skill 1 — Diagnóstico arquitectónico

Antes de proponer cambios, revisar siempre estas preguntas:

1. ¿Esto pertenece a WordPress core, Sage, ACF o gobi-core?
2. ¿Si cambio de theme, esto debe sobrevivir?
3. ¿Esto es presentación, configuración o negocio?
4. ¿La solución está metiendo workflow donde no corresponde?
5. ¿Esto se podrá mantener dentro de seis meses?

### Regla de clasificación rápida

- si solo cambia cómo se ve → **Sage**
- si es editable por el equipo editorial sin tocar negocio → **ACF**
- si afecta reglas, permisos, integridad o trazabilidad → **gobi-core**
- si ya existe nativamente y no necesita modelo propio → **WordPress core**

---

## Skill 2 — Diseño de dominio en WordPress

Cuando se modele una entidad del producto:

### Paso 1: decidir si merece CPT
Merece CPT si:
- tiene identidad propia
- tendrá detalle propio
- se relaciona con otras entidades
- tendrá filtros o consultas
- seguirá existiendo aunque cambie la portada

### Paso 2: decidir si merece taxonomía
Merece taxonomía si:
- clasifica
- agrupa
- sirve para filtrar
- no requiere workflow ni reglas de transición

### Paso 3: decidir si merece tabla propia
Merece tabla propia si:
- crecerá mucho
- necesita historial
- requiere consulta eficiente
- no es solo metadato simple

---

## Skill 3 — Construcción del plugin `gobi-core`

El plugin `gobi-core` debe construirse por módulos.  
Orden quirúrgico recomendado:

### Módulo 1 — bootstrap
Crear:
- archivo principal del plugin
- constantes
- autoload básico
- carpeta `includes/` o `src/`
- activación / desactivación

### Módulo 2 — registro del dominio
Registrar:
- CPTs
- taxonomías
- metaboxes mínimos si aplica
- hooks base

### Módulo 3 — capabilities y roles
Definir:
- mapa de capabilities
- asignación a roles
- helpers de autorización

### Módulo 4 — workflow de estados
Implementar:
- helper de transiciones válidas
- validación de cambios
- requisito de motivo
- guardado consistente

### Módulo 5 — bitácora
Crear:
- tabla propia
- función `gobi_log_action(...)`
- registro automático de cambios clave

### Módulo 6 — endpoints internos
Exponer:
- endpoints REST internos o privados
- validación por capability
- respuestas consistentes

---

## Skill 4 — Trabajo correcto en Sage

En Sage la misión es presentar, no gobernar.

### Sí hacer
- layouts
- partials
- sections
- Blade components
- View Composers
- helpers visuales
- templates del front

### No hacer
- reglas de workflow
- control de estados como motor
- queries complejas repetidas en Blade
- JS y CSS gigantes inline
- autorización real

### Patrón preferido
- Composer reúne datos
- Blade renderiza
- plugin decide negocio

---

## Skill 5 — Uso correcto de ACF Pro

Usar ACF solo donde aporte poder editorial real.

### Casos ideales
- portada curada
- destacados manuales
- bloques editoriales
- banners
- CTA
- explicadores visibles
- relaciones editoriales curadas

### Casos incorrectos
- estado de proyecto como motor del producto
- permisos
- historial
- transiciones
- auditoría
- reglas duras del sistema

### Regla práctica
Si la lógica debe seguir viva aunque ACF se desactive, no debe depender de ACF.

---

## Skill 6 — Auth0 en este proyecto

Auth0 no se integra como adorno.  
Se integra cuando ya existe una base de producto capaz de decidir permisos.

### Flujo correcto
1. usuario entra
2. clic en iniciar sesión
3. Auth0 autentica
4. WordPress crea/vincula usuario
5. `gobi-core` asigna rol/capabilities
6. front se adapta

### Qué no olvidar
- Auth0 = identidad
- `gobi-core` = autorización del producto
- ocultar UI no reemplaza validar permisos

---

## Skill 7 — Orden de implementación recomendado

Cuando haya duda sobre por dónde seguir, seguir este orden:

### Etapa A — base
- WordPress listo
- Sage funcionando
- ACF Pro activo
- plugin `gobi-core` creado

### Etapa B — dominio
- CPTs
- taxonomías
- metacampos mínimos
- capabilities
- roles

### Etapa C — workflow
- estado
- transiciones
- motivo obligatorio
- bitácora

### Etapa D — editorial
- Options Page
- home curada
- bloques de portada
- fallbacks

### Etapa E — front público
- listados
- detalle
- filtros
- navegación temática

### Etapa F — auth
- login social
- restricciones por capability
- UI por rol

### Etapa G — paneles internos
- bitácora visual
- curaduría avanzada
- métricas
- herramientas editoriales

---

## Skill 8 — Cómo escribir guías técnicas para este proyecto

Una buena guía para GOBi debe tener siempre:

1. objetivo
2. capa afectada
3. riesgo
4. pasos concretos
5. archivos involucrados
6. criterio de validación
7. qué no tocar

### Formato recomendado
- contexto breve
- decisión
- implementación paso a paso
- validación
- siguiente paso

---

## Skill 9 — Qué revisar cuando el proyecto “se desordena”

Checklist rápido:

- ¿Se metió lógica de dominio al theme?
- ¿Hay ACF resolviendo negocio?
- ¿Hay queries pesadas en Blade?
- ¿Faltan capabilities propias?
- ¿La bitácora quedó frágil?
- ¿El estado se está tratando como taxonomía?
- ¿La UI está intentando sustituir la seguridad real?

Si una de estas da “sí”, hay que corregir antes de seguir.

---

## Skill 10 — Entregables que más valor aportan ahora

En este momento, los entregables con mayor retorno son:

### Nivel 1 — más urgentes
- esqueleto real de `gobi-core`
- contrato de arquitectura
- mapa de entidades WordPress
- roadmap v1

### Nivel 2 — inmediatamente después
- CPTs y taxonomías registrados
- capabilities y roles
- helper de estados
- tabla de bitácora

### Nivel 3 — luego
- home editorial
- listados públicos
- integración Auth0
- paneles internos

---

## Skill 11 — Estándar de decisión “enterprise razonable”

Cuando haya varias soluciones posibles, elegir la que mejor cumpla esto:

- simple para una v1
- sólida para crecer
- nativa en WordPress
- mantenible por un equipo pequeño
- sin overengineering
- portable entre hosts
- separada por responsabilidades

---

## Skill 12 — Frases operativas que siempre deben guiar el trabajo

- **Sage solo presenta.**
- **ACF no es backend del producto.**
- **El estado es workflow, no taxonomía.**
- **La autorización real vive en plugin + capabilities.**
- **La bitácora importante vive en tabla propia.**
- **WordPress v1 debe ser nativa, sólida y mantenible.**
