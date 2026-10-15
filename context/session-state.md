# ns_open_streetmap — Session state

## 2026-10-14 — ns_license integration + premium strip + agent context

- Working copy on `main` (b743d66), uncommitted; no feature branch created.
- Added `nitsan/ns-license ^14.5.4` / `ns_license 14.5.4-14.9.99` (effective minimum now TYPO3 12.4.18).
  Version 14.0.0 → 14.1.0.
- Premium strip with "Start Free Trial" → ns_license module `?trial=ns_open_streetmap#free-section` in the edit
  form (resolver priority 44, moved to 46 on 2026-10-15) and the Page module preview, team-wide wording and design
  (see `features/premium-cta.md`).
- Verified live on TYPO3 14.3.7 classic (temporary activation via `PackageStates.php`, `extension:setup` for the
  address table, one hidden test element and address, temporary system-maintainer admin; all removed, config
  files restored byte-identical). PHP 8.4 and 8.1 lint clean.
- Created agent context (`AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/`); no previous context existed.
- Open: ns_license 14.5.4 not yet published; v12/v13 not tested; frontend map only code-read; v14 preview rows
  missing (pre-existing, `core.md`).

## 2026-10-15 — Context audit

- Code-read audit: coordinate eval classes are unregistered and never run (was "invalid value emptied");
  address translations unlinkable; set settings vs. constants, upgrade wizard scope and v14 deprecations added.
- 2026-10-15: resolver priority 44 → 46; 44 is already used by ns_social_login (core throws on duplicates).
