<?php

namespace Papi\Services;

/**
 * Papi\Services\Example
 * Example service that provides some kind of functionality that we would like to injest and use in the system
 * Services should contain reusable things... they provide a service of some kind and can remember state at a system level
 * Configure services at injection time to take advantage system wide
 */
class Example
{
	/**
	 * test()
	 * Return a string
	 */
    public function test()
    {
        return 'Test Service...';
    }
}
