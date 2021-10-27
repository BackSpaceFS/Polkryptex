<?php

/**
 * @package Genius
 * @license https://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace App\Common\Composers;

use App\Core\View\Blade\Composer;
use Illuminate\View\View;

/**
 * Additional logic for the views/licenses.blade view.
 *
 * @author  Pomianowski <kontakt@rapiddev.pl>
 * @license GPL-3.0 https://www.gnu.org/licenses/gpl-3.0.txt
 * @since   1.0.0
 */
final class LicensesComposer extends Composer implements \App\Core\Schema\Composer
{
  public function compose(View $view): void
  {
    $view->with('softwareList', [
      [
        'name' => 'Symfony Components',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/symfony'
      ],
      [
        'name' => 'Bramus Router',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/bramus/router'
      ],
      [
        'name' => 'PHPMailer',
        'license' => 'GNU Lesser General Public License v2.1',
        'url' => 'https://github.com/PHPMailer/PHPMailer'
      ],
      [
        'name' => 'FIDO2/Webauthn Support for PHP',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/web-auth/webauthn-lib'
      ],
      [
        'name' => 'Pest - PHP Testing Framework',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/pestphp/pest'
      ],
      [
        'name' => 'Illuminate Support',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/support'
      ],
      [
        'name' => 'Illuminate View',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/view'
      ],
      [
        'name' => 'Illuminate Config',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/config'
      ],
      [
        'name' => 'Illuminate Database',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/database'
      ],
      [
        'name' => 'Illuminate Cache',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/cache'
      ],
      [
        'name' => 'Illuminate Http',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/http'
      ],
      [
        'name' => 'Illuminate Translation',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/translation'
      ],
      [
        'name' => 'Illuminate Log',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/illuminate/log'
      ],
      [
        'name' => 'TypeScript',
        'license' => 'Apache License 2.0',
        'url' => 'https://github.com/microsoft/TypeScript'
      ],
      [
        'name' => 'Sass',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/sass/sass'
      ],
      [
        'name' => 'webpack',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/webpack/webpack'
      ],
      [
        'name' => 'webpack cli',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/webpack/webpack-cli'
      ],
      [
        'name' => 'TypeScript loader for webpack',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/TypeStrong/ts-loader'
      ],
      [
        'name' => 'webpack file-loader',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/webpack-contrib/file-loader'
      ],
      [
        'name' => 'webpack sass-loader',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/webpack-contrib/sass-loader'
      ],
      [
        'name' => 'copy-webpack-plugin',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/webpack-contrib/copy-webpack-plugin'
      ],
      [
        'name' => 'Workbox webpack plugin',
        'license' => 'The MIT License (MIT)',
        'url' => 'https://github.com/googlechrome/workbox'
      ],
      [
        'name' => 'ScrollReveal',
        'license' => 'GNU General Public License 3.0',
        'url' => 'https://scrollrevealjs.org/'
      ],
    ]);
  }
}