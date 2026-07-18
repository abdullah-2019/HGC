<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaBrowserController extends Controller
{
    public function index(Request $request)
    {
        $relativePath = trim($request->get('path', ''), '/');

        $basePath = public_path('storage');

        $currentPath = $relativePath
            ? $basePath . DIRECTORY_SEPARATOR . $relativePath
            : $basePath;

        abort_unless(
            File::exists($currentPath),
            404
        );

        $folders = collect(File::directories($currentPath))
            ->map(function ($folder) use ($basePath) {
                return [
                    'name' => basename($folder),
                    'path' => str_replace(
                        '\\',
                        '/',
                        ltrim(str_replace($basePath, '', $folder), '/')
                    ),
                ];
            });

        $images = collect(File::files($currentPath))
            ->filter(function ($file) {
                return in_array(
                    strtolower($file->getExtension()),
                    ['jpg', 'jpeg', 'png', 'webp', 'gif']
                );
            })
            ->map(function ($file) use ($basePath) {

                $relative = str_replace(
                    '\\',
                    '/',
                    ltrim(str_replace($basePath, '', $file->getPathname()), '/')
                );

                return [
                    'name' => $file->getFilename(),
                    'url' => '/storage/' . $relative,
                ];
            });

        return view(
            'admin.media.browser',
            compact(
                'folders',
                'images',
                'relativePath'
            )
        );
    }
}