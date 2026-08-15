<?php

namespace App\Support;

class MediaUrl
{
    /**
     * Build a full public URL from a stored filename and a media "type"
     * key defined in config/media.php (e.g. 'ads.images', 'identity').
     *
     * Returns null if no filename is given, so accessors can safely return
     * null instead of a broken URL like "https://site.com/assets/ads/".
     */
    public static function build(?string $filename, string $type): ?string
    {
        if (! $filename) {
            return null;
        }

        $base = rtrim(config('media.base_url'), '/');
        $path = trim(config("media.paths.$type"), '/');

        return "{$base}/{$path}/{$filename}";
    }
}
