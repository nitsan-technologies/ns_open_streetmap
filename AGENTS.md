# AGENTS.md — ns_open_streetmap (OpenStreetMap)

Agent router for the OpenStreetMap free extension. Load only what your task needs.

> **Principles:** `context/principles.md`
> **Session log:** `context/session-state.md`
> **Doc index:** `context/docs-map.md`

---

## Always load

| File | Why |
|---|---|
| `context/principles.md` | Guardrails, "nothing that works may break" rule |
| `context/core.md` | Identity, TYPO3/PHP/ns_license constraints, tooling, known issues |

---

## Task router

| Task | Load |
|---|---|
| Map content element: FlexForm, controller, frontend template, JS/CSS, TypoScript / site set | `context/features/map-plugin.md` |
| Address records (TCA, latitude/longitude validation) | `context/features/address-records.md` |
| Premium strip / free trial / ns_license dependency | `context/features/premium-cta.md` |
| Classes, tables, templates, TSconfig, assets, upgrade wizard | `context/architecture.md` |
| Lint / validate / manual test | `tasks/run-quality.md` |
| Update agent context after a change | `tasks/context-update.md` |

---

## Feature status

| Feature | Status | Agent entry |
|---|---|---|
| Map content element with Leaflet + OpenStreetMap tiles and an address sidebar | Done (code-read) | `context/features/map-plugin.md` |
| Address records with coordinate validation | Done (code-read; validation classes not registered, inactive) | `context/features/address-records.md` |
| Premium strip + ns_license free-trial deep link | Done (needs ns_license 14.5.4 release) | `context/features/premium-cta.md` |

---

## Quick commands

```bash
cd packages/ns_open_streetmap        # or typo3conf/ext/ns_open_streetmap in Classic mode
for f in $(find . -name "*.php" -not -path "./.git/*"); do php -l "$f"; done
composer validate --no-check-publish
for f in Resources/Private/Language/*.xlf Configuration/FlexForms/*.xml; do xmllint --noout "$f"; done
```
