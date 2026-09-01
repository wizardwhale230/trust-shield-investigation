<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class SafeMail
{
    /**
     * Execute a mail send callable and swallow any transport errors,
     * logging them instead of letting them surface to the user.
     *
     * Usage:
     *   SafeMail::send(fn() => Mail::to($user->email)->send(new WelcomeEmail($user)), ['user_id' => $user->id]);
     *
     * @param  callable  $callback  The mail send closure to execute.
     * @param  array     $context   Extra key/value pairs added to the log entry.
     */
    public static function send(callable $callback, array $context = []): void
    {
        try {
            $callback();
        } catch (\Throwable $e) {
            Log::error('Mail send failed: ' . $e->getMessage(), array_merge($context, [
                'exception_class' => get_class($e),
                'file'            => $e->getFile(),
                'line'            => $e->getLine(),
            ]));
        }
    }
}
