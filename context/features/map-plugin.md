# Feature — Map content element

*Status: Done. Code-read; the frontend was not rendered during the 2026-10-14 session. Known issues in
`core.md`.*

## Backend

- New content element wizard → Plugins → "Open Street Map" (CType `nsopenstreetmap_map`).
- Edit form, tab "plugin": premium strip (`premium-cta.md`), then the single FlexForm sheet "General":

  | Field | Config |
  |---|---|
  | `settings.address` | `selectMultipleSideBySide` on `tx_nsopenstreetmap_domain_model_address`, same `sys_language_uid` as the content element, max 999 |
  | `settings.height` | `number` (decimal), default 500, range 500–1000 |

  plus core "Record Storage Page" (`pages`).
- Page module preview: premium strip, then a table with the plugin title and sheet title (address/height rows
  are missing on v14, see `core.md`).

## Frontend

1. `listAction()` loads the selected addresses (`findAddress()`, ignores the storage page) or, with none
   selected, all addresses from the storage page (`findAll()`).
2. `List.html` renders `#map_{uid}` plus the sidebar `#sidebar_map_{uid}` with one `.map-add` item per address
   (title, RTE info content through `lib.parseFunc`).
3. `Settings.html` builds an inline config (`mapSettings.id/height/width`, `locations[]` with uid, title,
   coordinates rounded to 6 decimals and the rendered `InfoWindow` partial) and passes it through
   `ScriptViewHelper` as a footer file that calls `$('#map_…').nsopenstreetmap(config)`.
4. `map.js` creates a Leaflet map centred on the first address (zoom 14, no scroll-wheel zoom or dragging), adds
   OpenStreetMap tiles and one marker with popup per address. Clicking a sidebar item centres the map on it
   (zoom 16).
5. `custom.js` keeps the sidebar height equal to the map height on load and resize.

## TypoScript

- Classic static template "OpenStreetMap" or site set `nitsan/ns-openstreetmap` (setup imports the classic
  setup).
- `plugin.tx_nsopenstreetmap_map.view.*RootPath(s)` and `settings.jquery` / `settings.leafletjs`, which switch the
  bundled jQuery and Leaflet in `page.includeJSLibs`. CSS and `map.js` / `custom.js` are always included on every
  page.
