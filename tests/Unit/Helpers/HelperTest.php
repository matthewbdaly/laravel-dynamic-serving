<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Mockery as m;

class HelperTest extends TestCase
{
    /**
     * Test mobile helper returns true
     *
     * @return void
     */
    public function testMobileHelperReturnsTrue()
    {
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('get')
                ->with('mobile')
                ->once()
                ->andReturn(true);
        $this->app->instance('Illuminate\Contracts\Session\Session', $session);
        $this->assertTrue(is_mobile());
    }

    /**
     * Test mobile helper returns false
     *
     * @return void
     */
    public function testMobileHelperReturnsFalse()
    {
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('get')
                ->with('mobile')
                ->once()
                ->andReturn(false);
        $this->app->instance('Illuminate\Contracts\Session\Session', $session);
        $this->assertFalse(is_mobile());
    }

    /**
     * Test mobile helper returns false when not set
     *
     * @return void
     */
    public function testMobileHelperReturnsFalseWhenNotSet()
    {
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('get')
                ->with('mobile')
                ->once()
                ->andReturn(null);
        $this->app->instance('Illuminate\Contracts\Session\Session', $session);
        $this->assertFalse(is_mobile());
    }

    /**
     * Test desktop helper returns true
     *
     * @return void
     */
    public function testDesktopHelperReturnsTrue()
    {
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('get')
                ->with('mobile')
                ->once()
                ->andReturn(false);
        $this->app->instance('Illuminate\Contracts\Session\Session', $session);
        $this->assertTrue(is_desktop());
    }

    /**
     * Test desktop helper returns false
     *
     * @return void
     */
    public function testDesktopHelperReturnsFalse()
    {
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('get')
                ->with('mobile')
                ->once()
                ->andReturn(true);
        $this->app->instance('Illuminate\Contracts\Session\Session', $session);
        $this->assertFalse(is_desktop());
    }

    /**
     * Test desktop helper returns true when not set
     *
     * @return void
     */
    public function testDesktopHelperReturnsTrueWhenNotSet()
    {
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('get')
                ->with('mobile')
                ->once()
                ->andReturn(null);
        $this->app->instance('Illuminate\Contracts\Session\Session', $session);
        $this->assertTrue(is_desktop());
    }
}
