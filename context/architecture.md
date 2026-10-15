# ns_open_streetmap — Architecture

## Plugin registration

| File | What |
|---|---|
| `ext_localconf.php` | `configurePlugin('NsOpenStreetmap', 'Map', [AddressController => 'list'], same non-cacheable, PLUGIN_TYPE_CONTENT_ELEMENT)`; FormEngine `nodeResolver` 1791980645 (`flexFormNoTabsContainer`, priority 46) |
| `Configuration/TCA/Overrides/tt_content.php` | `registerPlugin(…, 'Map', 'OpenStreetMap', '', 'plugins')` → CType `nsopenstreetmap_map` on every major; FlexForm via `addPiFlexFormValue('*', …, CType)`; adds tab `plugin` with `pi_flexform,pages` after `subheader`; also sets `types.list.subtypes_excludelist/addlist` for the signature (no effect, the plugin is no `list_type`) |
| `Configuration/page.tsconfig` | New content element wizard entry (Plugins tab, icon `ext-open-street-map-icon`, `tt_content_defValues.CType`); Fluid preview `OpenStreetMap.html` for the CType and for `preview.list.nsopenstreetmap_map` (unused, no `list_type`) |
| `Configuration/Icons.php` | `ext-open-street-map-icon` → `assets/Icons/ns_open_streetmap.svg` |
| `Configuration/TCA/Overrides/sys_template.php` | Static template "OpenStreetMap" (`Configuration/TypoScript`) |
| `Configuration/Sets/ns_open_streetmap/` | Site set `nitsan/ns-openstreetmap`; `constants.typoscript` / `setup.typoscript` import the classic files (setup then repeats the classic setup); settings `plugin.tx_nsopenstreetmap_map.settings.jquery` / `.leafletjs` (bool, default on) win over the empty classic constants because core adds site settings after the set constants |

## Classes

| Class | Role |
|---|---|
| `Controller\AddressController` | `listAction()`: addresses from FlexForm `settings.address` (uids, any pid) or `findAll()`; assigns `locations`, `data` (content element row) |
| `Domain\Model\Address` | `title`, `infocontent`, `latitude`, `longitude` |
| `Domain\Repository\AddressRepository` | `findAddress(array $uids)` without storage restriction |
| `Evaluation\EvaluationLatitude` / `EvaluationLongitude` | TCA `eval` classes (coordinate regex, else `''`); not registered, so never called (`features/address-records.md`) |
| `ViewHelpers\ScriptViewHelper` | Writes children to a temp JS file and adds it as footer JS |
| `ViewHelpers\EscapeViewHelper` | Escapes `'` and removes newlines for JS string literals |
| `ViewHelpers\Be\PremiumStripViewHelper` | Premium strip in the Page module preview |
| `Backend\PremiumStrip` | Builds the strip HTML + trial URL |
| `Form\Resolver\PremiumStripFlexFormNoTabsContainerResolver`, `Form\Container\PremiumStripFlexFormNoTabsContainer` | Premium strip in the edit form |
| `Upgrades\OpenStreetMapCTypeMigration` | Upgrade wizard `OpenStreetMapCTypeMigration` (prerequisite `DatabaseUpdatedPrerequisite`): `list` + `list_type nsopenstreetmap_map` → CType `nsopenstreetmap_map` (skips if `list_type` column is gone). Its description promises a backend user permission migration, but only `CType` is updated |

DI: `Configuration/Services.yaml` autowires `Classes/*`; `AddressController` is public with an explicit repository
argument.

## Tables

- `tx_nsopenstreetmap_domain_model_address` (`ext_tables.sql`, `Configuration/TCA/…address.php`): workspace
  aware, `languageField` without `transOrigPointerField` (`features/address-records.md`),
  `ignorePageTypeRestriction`, default sort `title`.
- `tt_content`: uses `pi_flexform` and `pages` only.

## Views

- Frontend: `Templates/Address/List.html` (layout `Default`) → `Partials/Address/AddressList.html` (sidebar),
  `Partials/Address/Settings.html` (map JS config), `Partials/Address/InfoWindow.html` (popup).
- Backend preview: `Resources/Private/Backend/Backendpreview/OpenStreetMap.html` (used on all majors),
  `OpenStreetMapv14.html` (unused, see `core.md`). Both start with `<osm:be.premiumStrip />`.

## Assets

- Frontend (via TypoScript `page.*`): `assets/Css/style.css`, `assets/leaflet/leaflet.css`, optional
  `assets/js/jquery.min.js` and `assets/js/Leaflet.js`, footer `js/map.js`, `js/custom.js`.
- Backend: `assets/Css/backend-premium-strip.css`.
