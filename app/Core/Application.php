<?php

/**
 * @package   Polkryptex
 *
 * @copyright Copyright (c) 2021 - Kacper J., Pawel L., Filip S., Szymon K., Leszek P.
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Polkryptex\Core;

use Polkryptex\Common\Variables;

/**
 * @author Leszek P.
 */
final class Application
{
    /**
     * @link https://packagist.org/packages/monolog/monolog
     * @link https://github.com/nette/database
     * @link https://github.com/bramus/router
     */

    private function __construct()
    {
        Registry::register('App', $this);

        Registry::register('Debug', new Debug());
        Registry::register('Vars', new Variables());
        Registry::register('DB', new Database());
        
        (new Router());
    }

    /**
     * Returns a new application instance, should be triggered by public/index.php
     * @return Application
     */
    static function start(): Application
    {
        return new Application();
    }
}
