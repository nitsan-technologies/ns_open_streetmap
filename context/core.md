# ns_open_streetmap — Core facts

## Identity

| Item | Value |
|---|---|
| Extension key | `ns_open_streetmap` |
| Composer name | `nitsan/ns-open-streetmap` |
| Title (ext_emconf) / product name | TYPO3 OpenStreetMap Integration / OpenStreetMap |
| Namespace | `Nitsan\NsOpenStreetmap\` → `Classes/` |
| Version (ext_emconf) | 14.1.0 (latest tag 14.0.0) |
| Repository | https://github.com/nitsan-technologies/ns_open_streetmap (default branch `main`) |
| Licensing status | **Freemium** — this repo is the free version. The NITSAN Free/Freemium sheet needs a Google login; status taken from the T3Planet catalog (`isFree: false` for the premium product) |
| Premium version (T3Planet catalog) | "OpenStreetMap", €169, https://t3planet.de/en/typo3-openstreetmap-extension |

## Compatibility

| Source | TYPO3 | PHP |
|---|---|---|
| `ext_emconf.php` | `12.0.0-14.9.99` | not declared |
| `composer.json` | `^12 \|\| ^13 \|\| ^14` | not declared |
| ns_license 14.5.4 (dependency) | `12.4.18-14.9.99` | not declared (TYPO3 12.4 needs 8.1+) |

- Effective minimum is **TYPO3 12.4.18 / PHP 8.1** because of ns_license; the declared `12.0.0` lower bound is
  kept as is.

## Dependencies

| Package | Constraint | Why |
|---|---|---|
| `typo3/cms-core` | see above | core |
| `nitsan/ns-license` / `ns_license` | `^14.5.4` / `14.5.4-14.9.99` | TYPO3 Shop module + free-trial deep link (see `features/premium-cta.md`) |

Bundled frontend libraries (no package manager): jQuery, Leaflet (`Resources/Public/assets/js/`), Leaflet CSS +
marker images (`assets/leaflet/`).

## Tooling

- No PHPUnit, PHPStan, CS fixer or package.json in the repo.
- CI: `.github/workflows/ter-release.yml` only (publishes tags to TER with tailor on PHP 7.4).
- `.gitattributes` export-ignores `.github/`, `AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/` and itself, so they
  are not in the GitHub/Composer archive or the TER package (the TER release uploads the GitHub tag archive).
- No Crowdin config; source labels in `Resources/Private/Language/locallang.xlf` (plugin, address, premium strip)
  and `locallang_db.xlf` (TCA, FlexForm, constants, preview).

## Conventions

- Extbase plugin `NsOpenStreetmap` / `Map`, registered as content element `nsopenstreetmap_map`.
- Mixed code style (tabs in XLF/templates, 4 spaces in PHP); new PHP files use `declare(strict_types=1)`.
- Backend CSS lives next to the frontend CSS in `Resources/Public/assets/Css/`.

## Known issues (existing, not fixed)

Behaviour details: `features/map-plugin.md`, `features/address-records.md`.

Verified live on v14.3.7:

- Page module preview shows only the "Open Street Map" and "General" headings; the address and height rows are
  missing. `page.tsconfig` points v14 to `OpenStreetMap.html`, which reads `pi_flexform_transformed`, but the v14
  `FluidBasedContentPreviewRenderer` only assigns `record`. `OpenStreetMapv14.html` (reads `record.pi_flexform…`)
  exists but is not referenced. Code-read: the v12 and v13 core renderers still assign `pi_flexform_transformed`,
  so the rows should render there.
- Both preview templates use `locallang_db.xl` (missing `f`); the labels still resolve.
- The edit-form tab is labelled lower-case "plugin" (`--div--;plugin` in `TCA/Overrides/tt_content.php`).

Code-read:

- `map.js` reads `locations[0]` for the initial view, so a map without addresses throws. With no address
  selected, `listAction()` falls back to `findAll()`, which respects the storage page (plugin "Record Storage
  Page" / `persistence.storagePid`, none configured by default).
- Classic TypoScript constants `jquery` and `leafletjs` default to empty, so jQuery and Leaflet are not included
  unless enabled in the Constant Editor; the site set defaults both to on.
- `settings.zoom` and `settings.defaulttype` are used in the templates but defined nowhere; zoom is hard-coded
  (14, 16 on sidebar click) in `map.js`, and scroll-wheel zoom and dragging are disabled.
- `map.js` checks `mapSettings.heigth` (typo), so the condition is always true.
- Tiles load directly from `tile.openstreetmap.org` with no consent handling.
- `ScriptViewHelper` writes the map JS to a new `typo3temp` file per distinct content; the plugin action is
  non-cacheable.
- Address TCA uses `LLL:EXT:lang/…` labels (extension removed in TYPO3 9), `type input` + `eval datetime`,
  `eval required`, `l10n_mode mergeIfNotBlank`, `defaultExtras`, and references an undefined `interaction`
  palette; `ext_tables.sql` keeps legacy `cruser_id` / `t3ver_*` columns.
- Deprecated in TYPO3 14 (removed in v15): `ExtensionManagementUtility::addPiFlexFormValue()` in
  `TCA/Overrides/tt_content.php`, and the `TYPO3\CMS\Install\Attribute\UpgradeWizard` /
  `TYPO3\CMS\Install\Updates\…` classes used by the upgrade wizard (moved to EXT:core, `TYPO3\CMS\Core\…`).
- `locallang_csh_tx_nsgooglemap_domain_model_address.xlf` (ns_google_map leftover), `bootstrap.min.css`,
  `ext-open-street-map-icon.svg` and the glyphicons fonts are unused.
- Site set `config.yaml`: name `nitsan/ns-openstreetmap`, label "NsOpenStreetMap Sets", no dependencies.
- Descriptions are stale: `composer.json` says "compatible with TYPO3 v12", `ext_emconf.php` "v12 and v13",
  README badge v13.0.1; `composer.json` uses the deprecated SPDX id `GPL-2.0+`.
