<?php

if (! function_exists('swiss_money')) {
    /**
     * Format a monetary value using Swiss conventions: apostrophe as the
     * thousands separator, a dot as the decimal separator, prefixed with
     * the currency code, e.g. swiss_money(1561.89) === "CHF 1'561.89".
     */
    function swiss_money(float|int|string|null $value, string $currency = 'CHF'): string
    {
        $formatted = number_format((float) $value, 2, '.', "'");

        return trim($currency . ' ' . $formatted);
    }
}
