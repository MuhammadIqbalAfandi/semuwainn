<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThumbnailController extends Controller
{
    public function process(Request $request)
    {
        if ($request->hasFile('thumbnails')) {
            foreach ($request->file('thumbnails') as $image) {
                $path = $image->store('tmp');
                return response()->make($path, 200, ['Content-Type' => 'text/plain']);
            }
        }
    }

    public function revert(Request $request)
    {
        $filePath = $request->getContent();
        if ($filePath) {
            Storage::delete($filePath);

            return response()->make('', 200, [
                'Content-Type' => 'text/plain',
            ]);
        }
    }

    public function load(RoomType $roomType)
    {
        return dd($roomType);
    }
}
