<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

trait HandlesMediaUpload
{
    protected function storeMediaFile(UploadedFile $file, string $mediaType): string
    {
        $destination = public_path(config("media.paths.$mediaType"));

        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension    = $file->getClientOriginalExtension();
        $safeName     = \Illuminate\Support\Str::slug($originalName);

        $filename = $safeName . '.' . $extension;
        $counter  = 1;
        while (is_file($destination . DIRECTORY_SEPARATOR . $filename)) {
            $filename = $safeName . '-' . $counter . '.' . $extension;
            $counter++;
        }

        $file->move($destination, $filename);

        return $filename;
    }

    protected function deleteMediaFile(?string $filename, string $mediaType): void
    {
        if (! $filename) {
            return;
        }

        $path = public_path(config("media.paths.$mediaType")) . DIRECTORY_SEPARATOR . basename($filename);

        if (is_file($path)) {
            @unlink($path);
        }
    }
}
