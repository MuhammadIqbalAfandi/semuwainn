<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThumbnailController extends Controller
{
    public function process(Request $request)
    {
        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $image) {
                $path = $image->store('tmp');

                return response($path, 200, ['Content-Type' => 'text/plain']);
            }
        }
    }

    public function revert(Request $request)
    {
        $filePath = $request->getContent();
        if ($filePath) {
            Storage::delete($filePath);

            return response('', 200, []);
        }
    }

    public function load(Request $request)
    {
        $fileName = $request->load;
        if ($fileName) {
            return response()
                ->file(
                    public_path('storage/thumbnails/' . $fileName),
                    ['Content-Disposition: inline;filename="' . $fileName . '"']
                );
        }
    }
}
