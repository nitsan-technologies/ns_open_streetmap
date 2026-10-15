# ns_open_streetmap — Operating Principles

*Every change to code, context or docs must serve the goals below.*

---

## Goal 1 — Nothing that works may break

The extension declares TYPO3 v12–v14 (Composer and Classic mode), see `core.md`.

- Keep every declared major working. Follow the existing version switches (v12 constructor vs. v13+ `setData()`
  in the FormEngine resolver, `enum_exists(IconSize::class)`) instead of inventing new ones; for v14-only preview
  markup use a `[typo3.branch >= "14.0"]` page TSconfig condition like ns_news_comments.
- Lowest PHP is 8.1 (TYPO3 12): no PHP 8.2+ syntax such as `readonly` classes or DNF types.
- Prefer the smallest change that fixes the root cause. No drive-by refactors.
- Run `tasks/run-quality.md` and re-test the affected flow (frontend map, Page module, edit form) before claiming
  done.

## Goal 2 — Token-cost efficiency (agent context)

- **DRY context:** each fact lives in exactly ONE file. Reference, don't copy.
- **Load on demand:** read `context/features/<area>.md` for the task, not everything.
- **Prune as you go:** keep `context/session-state.md` short.

## Goal 3 — Accuracy and trust

- Answer from context + code, never from invented API, table or field names.
- Mark statements as verified live or code-read; conflicting facts across files = fix the source file.

---

## Guardrails (non-negotiable)

- FormEngine resolver priorities for `flexFormNoTabsContainer` must be unique per installation (core throws on
  duplicates). NITSAN extensions use 40 (ns_news_comments), 41 (ns_event), 42 (ns_gallery), 43 (ns_helpdesk),
  44 (ns_social_login), 45 (ns_faq), 46 (this extension). Pick the next free number for a new one.
- Installing the premium version through ns_license replaces this extension's folder: never keep user data in
  files below the extension.
- Do not change ns_license from an ns_open_streetmap task; reuse its module and trial modal.
- All UI text goes into `Resources/Private/Language/*.xlf`, no hard-coded labels. Only the English source files
  are edited; translations are not part of this repo.

---

## Apply this whenever you

- Edit `context/` or `AGENTS.md`
- Land a feature or bugfix (update the matching `context/features/*.md` + `session-state.md`)
