# INICIO.md — GOBi WordPress v1 (Versión Oficial)

## Qué es GOBi

GOBi es una plataforma de inteligencia política para Costa Rica.

Su objetivo es traducir la actividad legislativa en información:

- navegable
- entendible
- accionable

## Arquitectura oficial

- WordPress → base
- Sage → presentación
- gobi-core → dominio
- ACF → editorial
- Auth0 → identidad

## Regla principal

**El dominio nunca vive en el theme.**

## Estado actual del proyecto

### Ya está resuelto
- Sage funcionando con Vite
- estructura de theme correcta
- separación conceptual clara
- flujo de desarrollo local estable

### Falta construir
- plugin gobi-core
- CPTs reales
- taxonomías
- workflow de estados
- bitácora
- capabilities y roles
- home editorial
- Auth0 real

## Fase actual

**Construcción de base WordPress v1.**

## Prioridad inmediata

**Crear gobi-core**

- Registrar dominio mínimo:
  - proyectos
  - diputados
  - comisiones
- Definir:
  - estados
  - transiciones
  - capabilities
  - bitácora

## Regla operativa

**No avanzar UI sin dominio.**

## Frase guía

> WordPress hospeda.
> Sage renderiza.
> ACF edita.
> Auth0 autentica.
> gobi-core gobierna.
