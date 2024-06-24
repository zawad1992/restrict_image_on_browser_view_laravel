<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function serveImage(Request $request)
    {
        $image = $request->query('image');
        $token = $request->query('token');
        $expiry = $request->query('expiry');

        if ($this->validateToken($token, $image, $expiry) && $expiry > time() && Auth::check()) {
            $path = storage_path('app/private_images/' . $image);
            if (file_exists($path)) {
                return response()->file($path);
            } else {
                return response("Image not found", 404);
            }
        } else {
            return response("Access denied", 403);
        }
    }

    private function validateToken($token, $image, $expiry)
    {
        $secret = 'your_secret_key';
        return hash('sha256', $image . $expiry . $secret) === $token;
    }
}
