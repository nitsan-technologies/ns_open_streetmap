# Run quality checks

The repo has no PHPUnit, PHPStan or CS config. Available checks:

```bash
# PHP syntax; also run once with PHP 8.1, the lowest version TYPO3 12 supports
for f in $(find . -name "*.php" -not -path "./.git/*"); do php -l "$f"; done

# composer.json
composer validate --no-check-publish

# XLF / FlexForm well-formedness
for f in Resources/Private/Language/*.xlf Configuration/FlexForms/*.xml; do xmllint --noout "$f"; done
```

## Manual test (per TYPO3 major 12 / 13 / 14)

Setup: activate the extension (database schema needed for the address table), include the static template or
site set, enable jQuery and Leaflet in the constants.

1. List module: create two address records with valid coordinates (invalid values are saved as entered, see
   `context/features/address-records.md`).
2. Page module → + Content → Plugins → "Open Street Map". Tab "plugin": premium strip above the Address field;
   select both addresses, height 600. Save.
3. Page module preview: strip above the preview table.
4. "Start Free Trial" (as system maintainer) opens the ns_license module and its trial modal with
   "OpenStreetMap (ns_open_streetmap)" preselected. Cancel; don't start a trial.
5. Frontend: map with two markers and popups, sidebar list; clicking an item centres the map.
6. Check light and dark backend themes; check that other FlexForm plugins (ns_news_comments, ns_event,
   ns_gallery, ns_helpdesk) still show their own strip and nothing from this extension.

Remove the test content element and address records afterwards.
