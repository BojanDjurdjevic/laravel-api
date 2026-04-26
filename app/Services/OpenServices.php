<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Process\Factory;

class OpenServices
{
    public function generatePromptFromImage(UploadedFile $image): string
    {
        $imageData = base64_encode(file_get_contents($image->getPathname()));
        $mimeType = $image->getMimeType();

        $client = (new Factory())->make();

        return 'message';
    }
}
