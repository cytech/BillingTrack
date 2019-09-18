Translations
---

---

[How do I translate BillingTrack into my own language?](#how-do-i-translate-billingtrack-into-my-own-language)

---

<a id="how-do-i-translate-billingtrack-into-my-own-language"></a>
### How do I translate BillingTrack into my own language?

The translation files for BillingTrack live in the resources/lang
folder. To translate BillingTrack into your native language, create a
new folder inside resources/lang for your language and then copy the
files from resources/lang/en into your specific language folder. Once
the files have been copied, you can begin the translation.

The example below demonstrates the structure of the language files. In
the example below, account\_setup is the language key used to reference
the English phrase 'Account Setup'. Translate each of the phrases after
the =&gt; to your language. Do not change the language keys on the left.

    return [
        'account_setup'                      => 'Account Setup',
        'active'                             => 'Active',
        'active_client'                      => 'Active Client',
        'add_client'                         => 'Add Client',
        ...

Might become:

    return [
        'account_setup'                      => 'Configuración de la cuenta',
        'active'                             => 'Activo',
        'active_client'                      => 'Cliente activo',
        'add_client'                         => 'Crear cliente',
        ...

---
