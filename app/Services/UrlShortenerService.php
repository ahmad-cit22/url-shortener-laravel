<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Url;

class UrlShortenerService
{
    public function shortenUrl($originalUrl)
    {
        if (!filter_var($originalUrl, FILTER_VALIDATE_URL)) {
            return [
                'error' => 'Invalid URL'
            ];
        }

        $shortUrl = Str::random(6);

        while (Url::where('short_url', $shortUrl)->exists()) {
            $shortUrl = Str::random(6);
        }

        return [
            'original_url' => $originalUrl,
            'short_url' => $shortUrl,
            'error' => null
        ];
    }
}
