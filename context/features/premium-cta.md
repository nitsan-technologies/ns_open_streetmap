# Feature — Premium strip and ns_license free trial

*Status: Done. Verified live on TYPO3 14.3.7 (2026-10-14): strip in the Page module preview and in the edit form,
trial modal opens with "OpenStreetMap (ns_open_streetmap)" preselected. Requires ns_license 14.5.4 (deep-link
support) to be released. v12/v13 not tested.*

## Licensing status

Freemium. Premium product (T3Planet catalog): "OpenStreetMap", €169,
https://t3planet.de/en/typo3-openstreetmap-extension (not linked from the UI; the trial stays inside the TYPO3
backend). The catalog advertises predefined map styles (street, satellite, terrain, hybrid), location pop-ups and
directions; the free version has one tile style and pop-ups only.

## Dependency

`composer.json` `"nitsan/ns-license": "^14.5.4"`, `ext_emconf.php` `'ns_license' => '14.5.4-14.9.99'`. This
raises the effective minimum to TYPO3 12.4.18 (see `core.md`).

## Where it shows

| Place | How |
|---|---|
| Edit form of an OpenStreetMap content element, tab "plugin", above the Address field | FormEngine node resolver replaces `flexFormNoTabsContainer` for `pi_flexform` (the FlexForm has one sheet) |
| Page module preview of the content element, above the preview table | `<osm:be.premiumStrip />` at the top of both preview templates |

Not shown on address records or other content elements. Shown to every backend user who can see the element;
ns_license's module is system-maintainer only, so other users get access denied after clicking.

## Classes

| File | Role |
|---|---|
| `Classes/Backend/PremiumStrip.php` | Builds the HTML; link = route `nitsan_nslicensemodule` + `trial=ns_open_streetmap` + `#free-section`; returns `''` when the route is missing (ns_license not active) |
| `Classes/Form/Resolver/PremiumStripFlexFormNoTabsContainerResolver.php` | Registered in `ext_localconf.php` (`nodeResolver` 1791980645, priority 46, see the priority guardrail in `principles.md`); matches `tt_content`, field `pi_flexform`, not inline, CType `nsopenstreetmap_map` or `list` + matching `list_type` |
| `Classes/Form/Container/PremiumStripFlexFormNoTabsContainer.php` | Extends core `FlexFormNoTabsContainer`, prepends the strip and adds the stylesheet |
| `Classes/ViewHelpers/Be/PremiumStripViewHelper.php` | Preview: renders the strip and adds the stylesheet through `PageRenderer` |
| `Resources/Public/assets/Css/backend-premium-strip.css` | `.ns-open-streetmap-premium-strip` (light/dark via `light-dark()`); `.panel >` variant for the edit form |
| `locallang.xlf` | `premium.strip.headline`, `premium.strip.description`, `premium.strip.trial` |

If the FlexForm ever gets a second sheet, core switches to `flexFormTabsContainer` and the edit-form strip
disappears; then register the resolver for that node instead (see ns_revolution_slider).

## Design and wording

Team-wide standard from the 2026-10-14 review, identical in every NITSAN strip except for the extension name:

- Light-blue card (`#e7f2fc`, border `#8eb6e8`, 4px `#2b6cb0` left accent, 6px radius, padding 14px 18px), inset
  16px inside the FlexForm panel; `actions-rocket` icon; `btn btn-primary` `#007bff` (hover `#0062cc`).
- Headline "You're using the free version of NS OpenStreetMap" (semibold, 1.1em), description "Unlock premium
  features and get more out of NS OpenStreetMap.", button "Start Free Trial →" (the arrow is `aria-hidden`
  markup, not part of the label).
- Measured on v14.3.7: 12px text, 13.2px headline, 12px button, 67px high when the button fits on one line.
