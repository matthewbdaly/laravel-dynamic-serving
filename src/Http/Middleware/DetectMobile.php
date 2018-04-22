<?php

namespace Matthewbdaly\LaravelDynamicServing\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Contracts\Session\Session;

/**
 * Detects mobile devices and adds a flag to the session.
 * This flag can then be used to serve up mobile-specific views.
 */
class DetectMobile
{
    /**
     * Agent instance
     *
     * @var
     */
    protected $agent;

    /**
     * Session instance
     *
     * @var
     */
    protected $session;

    /**
     * Constructor
     *
     * @param Agent   $agent   The agent instance.
     * @param Session $session The session instance.
     * @return void
     */
    public function __construct(Agent $agent, Session $session)
    {
        $this->agent = $agent;
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request The request instance.
     * @param  \Closure                 $next    The next callback.
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->session->exists('mobile')) {
            if ($this->agent->isMobile() || $this->agent->isTablet()) {
                $this->session->put('mobile', true);
            } else {
                $this->session->put('mobile', false);
            }
        }
        $response = $next($request);
        return $response->setVary('User-Agent');
    }
}
