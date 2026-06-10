<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

class VerifyRecaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $request->input('g-recaptcha-response');

        $client = new Client();
        $verify = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $response
            ]
        ]);

        $body = json_decode((string)$verify->getBody());
        if (!$body->success) {
            return redirect()->back()->with('error', 'โปรดติ๊กถูก reCAPTCHA เพื่อยืนยันว่าคุณไม่ใช่ robot.');
        }

        return $next($request);
    }
}
