<?php

namespace App\Support;

trait NormalizesPhoneNumbers
{
    private function normalizeDigits(string $value): string
    {
        return preg_replace('/\D+/', '', $value) ?? '';
    }

    private function toWhatsappNumber(?string $phone): ?string
    {
        if (! $phone) {
            return null;
        }

        $digits = $this->normalizeDigits($phone);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits ?: null;
    }
}
