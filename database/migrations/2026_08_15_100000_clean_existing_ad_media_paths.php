<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * DATA migration (no schema change). Cleans up existing rows in the ads
 * table so ImageAd and VideoAd store ONLY the filename, never a path.
 *
 * Adjust the table name ('ads') and primary key ('IdAd') below if they
 * differ in your actual schema.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('ads')->orderBy('IdAd')->chunkById(100, function ($ads) {
            foreach ($ads as $ad) {
                $updates = [];

                if (! empty($ad->ImageAd) && str_contains($ad->ImageAd, '/')) {
                    $updates['ImageAd'] = basename($ad->ImageAd);
                }

                if (! empty($ad->VideoAd)) {
                    $videos = json_decode($ad->VideoAd, true);
                    if (is_array($videos)) {
                        $cleaned = array_map(
                            fn ($v) => str_contains($v, '/') ? basename($v) : $v,
                            $videos
                        );
                        if ($cleaned !== $videos) {
                            $updates['VideoAd'] = json_encode($cleaned);
                        }
                    }
                }

                if (! empty($updates)) {
                    DB::table('ads')->where('IdAd', $ad->IdAd)->update($updates);
                }
            }
        }, 'IdAd');
    }

    public function down(): void
    {
        // Not reversible — original full paths aren't recoverable.
    }
};
