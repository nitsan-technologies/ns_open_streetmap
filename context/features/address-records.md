# Feature — Address records

*Status: Done. Code-read; one record was created through SQL for the 2026-10-14 strip test and removed again.
Known issues in `core.md`.*

Table `tx_nsopenstreetmap_domain_model_address`, created in List module on any page (also folders,
`ignorePageTypeRestriction`).

| Field | Form | Rules |
|---|---|---|
| `title` | input | required, trim; also the record label and default sorting |
| `latitude` | input (palette `data`) | required, trim; `eval` also names `EvaluationLatitude` (−90…90, up to 15 decimals), which never runs (see below) |
| `longitude` | input (palette `data`) | required, trim; `eval` also names `EvaluationLongitude` (−180…180, up to 15 decimals), which never runs |
| `infocontent` | RTE, tab "Info Content" | trim; shown in the sidebar and the marker popup |

- Code-read: core only calls a custom `eval` class that is registered in
  `$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']` (DataHandler and FormEngine check this).
  The extension does not register `EvaluationLatitude` / `EvaluationLongitude`, so any coordinate string is
  saved as entered (only trimmed); nothing is emptied and there is no error message.
- Language (`languageField` `sys_language_uid`), workspaces (`versioningWS`), hidden/start/end time are set in
  `ctrl`, but `sys_language_uid`, hidden and the `time` palette are not in `showitem`. There is no
  `transOrigPointerField` (the `l10n_parent` column exists only in `ext_tables.sql`), so translations cannot be
  linked to their default-language record.
- The plugin's address select only offers records in the content element's language.
