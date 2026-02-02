<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Les proxies à faire confiance.
     *
     * Ici on met '*' pour accepter tous les reverse proxies (Render, Cloudflare, etc.)
     */
    protected $proxies = '*';

    /**
     * Les en-têtes utilisés pour détecter HTTPS.
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}

