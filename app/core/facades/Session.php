<?php

namespace App\Core\Facades;

use App\Core\Facades\Abstract\Facade;

/**
 * Stores information about from the current session.
 *
 * @author  Pomianowski <kontakt@rapiddev.pl>
 * @license GPL-3.0 https://www.gnu.org/licenses/gpl-3.0.txt
 * @since   1.1.0
 */
final class Session extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor(): string
  {
    return 'session';
  }
}
