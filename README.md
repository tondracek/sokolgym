# sokolgym
Projekt rezervačního systému pro menší posilovnu.

# Princip kódu
Uživatel vybere volný termín, ve který chce posilovnu navštívit. Stisknutím tlačítka "Zarezervovat" nahraje do session uložiště identifikátor daného termínu.
Po otevření dialogového okna a stisknutí "Příhlásit se" se spustí skript na odeslání potvrzovacího emailu (session_join_mail.php).
Kliknutím na odkaz v emailu se odešle požadavek na zapsání jména k danému termínu pokud je termín volný.

# Úpravy
Databáze - projekt aktuálně funguje pouze s JSON databází, bude nahrazena SQL serverem.

...
Ukázka bez funkčního php - tondracek.github.io/sokolgym
