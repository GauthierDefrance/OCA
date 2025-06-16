<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechController extends Controller
{
    public function index()
    {
        $ip = request()->ip();

        // Utiliser l'API ip-api.com pour géolocaliser l'IP
        $url = "http://ip-api.com/json/{$ip}?fields=status,message,country,city,lat,lon";

        $response = @file_get_contents($url);
        $data = json_decode($response, true);

        $gps = [
            'latitude' => $data['lat'] ?? null,
            'longitude' => $data['lon'] ?? null,
            'country' => $data['country'] ?? null,
            'city' => $data['city'] ?? null,
        ];

        $userAgent = request()->header('User-Agent');

        return view('pages.tech.index', compact('ip', 'gps', 'userAgent'));
    }
}
