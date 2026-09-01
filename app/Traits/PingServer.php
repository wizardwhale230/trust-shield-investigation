<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

/**
 * Stubbed trait — external phone-home to getonlinetrader.pro removed.
 * Methods return safe empty responses so existing callers don't crash.
 */
trait PingServer
{
    public function callServer($action, $url, $data = []): Response
    {
        return new Response(new \GuzzleHttp\Psr7\Response(200, [], json_encode([
            'error' => true,
            'message' => 'External API removed for security.',
        ])));
    }

    public function fetctApi(string $url, array $data = [], string $method = 'GET'): Response
    {
        return new Response(new \GuzzleHttp\Psr7\Response(200, [], json_encode([
            'error' => true,
            'message' => 'External API removed for security.',
        ])));
    }

    public function backWithResponse(Response $response): array
    {
        return [
            'type' => 'message',
            'message' => 'This feature is no longer available.',
        ];
    }
}
