<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/viewsource', function () {
    $url = trim(request('url'));
        if (str_starts_with($url, 'data:')) {
            return view('welcome', [
                'source' => 'Data URLs (base64-encoded images or files) are not supported.',
                'url' => $url
            ]);
        }
    if ($url === '') {
        return view('welcome', ['source' => 'Invalid URL', 'url' => '']);
    }
    if (!preg_match('/^https?:\/\//i', $url)) {
        $url = 'https://' . $url;
    }
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return view('welcome', ['source' => 'Invalid URL', 'url' => $url]);
    }
    try {
        $response = Http::timeout(5)->get($url);
        if ($response->successful()) {
            $contentType = $response->header('Content-Type');
            if ($contentType && str_starts_with($contentType, 'text/html')) {
                return view('welcome', ['source' => $response->body(), 'url' => $url]);
            } else {
                return view('welcome', [
                    'source' => 'The URL does not point to an HTML page. Content-Type: ' . ($contentType ?? 'unknown'),
                    'url' => $url
                ]);
            }
        }
        return view('welcome', [
            'source' => 'HTTP Error: ' . $response->status(),
            'url' => $url
        ]);
    } catch (Exception $e) {
        return view('welcome', [
            'source' => 'Connection failed (domain may not exist or server is down)',
            'url' => $url
        ]);
    }
})->name('viewsource.post');