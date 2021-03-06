<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait ThrottlesLogins
{
    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts()
        );
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request), $this->decayMinutes() * 60
        );
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    /**
     * Fire an event when a lockout occurs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return $this->removeSpecialCharacters(Str::lower($request->input($this->username())).'|'.$request->ip());
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }

    /**
     * Remove special characters that may allow users to bypass rate limiting.
     *
     * @param  string  $key
     * @return string
     */
    protected function removeSpecialCharacters($key)
    {
        $values = [
            '???' => 'a',
            '???' => 'b',
            '???' => 'c',
            '???' => 'd',
            '???' => 'e',
            '???' => 'f',
            '???' => 'g',
            '???' => 'h',
            '???' => 'i',
            '???' => 'j',
            '???' => 'k',
            '???' => 'l',
            '???' => 'm',
            '???' => 'n',
            '???' => 'o',
            '???' => 'p',
            '???' => 'q',
            '???' => 'r',
            '???' => 's',
            '???' => 't',
            '???' => 'u',
            '???' => 'v',
            '???' => 'w',
            '???' => 'x',
            '???' => 'y',
            '???' => 'z',
            '???' => '1',
            '???' => '2',
            '???' => '3',
            '???' => '4',
            '???' => '5',
            '???' => '6',
            '???' => '7',
            '???' => '8',
            '???' => '9',
            '???' => '10',
            '???' => '11',
            '???' => '12',
            '???' => '13',
            '???' => '14',
            '???' => '15',
            '???' => '16',
            '???' => '17',
            '???' => '18',
            '???' => '19',
            '???' => '20',
            '???' => '0',
            '???' => '1',
            '???' => '2',
            '???' => '3',
            '???' => '4',
            '???' => '5',
            '???' => '6',
            '???' => '7',
            '???' => '8',
            '???' => '9',
            '???' => '10',
            '???' => '11',
            '???' => '12',
            '???' => '13',
            '???' => '14',
            '???' => '15',
            '???' => '16',
            '???' => '17',
            '???' => '18',
            '???' => '19',
            '???' => '20',
            '???' => '0',
        ];

        return strtr($key, $values);
    }
}
