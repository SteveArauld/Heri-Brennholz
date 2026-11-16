<?php

return [

    'locales' => [
        'de' => 'Deutsch',
    ],

    'fallback' => 'de',

    'groups' => [
        [
            'label' => 'Message de paiement',
            'hint' => 'Un seul texte pour les phrases affichées au client. Le HTML simple est accepté : entourez chaque phrase avec <p> et </p>.',
            'keys' => [
                'bank.message_html',
            ],
        ],
        [
            'label' => 'Coordonnées bancaires',
            'hint' => 'Cochez la case pour les afficher aussi sur la page de confirmation, sous le message. « Supprimer le RIB » les retire de toutes les pages. Vous pouvez les saisir à nouveau ensuite.',
            'keys' => [
                'bank.show_on_confirmation',
                'bank.holder',
                'bank.iban',
                'bank.bic',
                'bank.transfer_type',
            ],
        ],
    ],

    'fields' => [
        'bank.message_html' => [
            'label' => 'Texte complet',
            'type' => 'html',
        ],
        'bank.show_on_confirmation' => [
            'label' => 'Afficher le nom, l’IBAN, le BIC et le type de virement sur la page de confirmation',
            'type' => 'checkbox',
        ],
        'bank.holder' => ['label' => 'Nom du titulaire', 'type' => 'text'],
        'bank.iban' => ['label' => 'IBAN', 'type' => 'text'],
        'bank.bic' => ['label' => 'BIC', 'type' => 'text'],
        'bank.transfer_type' => ['label' => 'Type de virement', 'type' => 'text'],
    ],

    'defaults' => [
        'bank.message_html' => '<p>Bitte überweisen Sie den Gesamtbetrag im Voraus auf unser Bankkonto. Die Bestellung wird erst nach Zahlungseingang versandt.</p><p>Nach der Überweisung können Sie uns den Zahlungsbeleg per E-Mail senden, um den Versand zu beschleunigen.</p>',
        'bank.show_on_confirmation' => '1',
        'bank.holder' => '',
        'bank.iban' => '',
        'bank.bic' => '',
        'bank.transfer_type' => '',
    ],

];
