<?php

namespace App\Common\Requests;

use App\Core\View\Request;
use App\Core\Http\Status;
use App\Core\Auth\Account;

/**
 * Action triggered during signing in.
 *
 * @author  Kujawski <szymonspam@wp.pl>
 * @license GPL-3.0 https://www.gnu.org/licenses/gpl-3.0.txt
 * @since   1.1.0
 */
final class ContactRequest extends Request implements \App\Core\Schema\Request
{
  public function getAction(): string
  {
    return 'Contact';
  }

  public function process(): void
  {
    $this->isSet([
      'email',
      'message'
    ]);

    $this->isEmpty([
      'email',
      'message'
    ]);

    $this->validate([
      ['email', FILTER_VALIDATE_EMAIL]
    ]);
    mail("kujawskiszymon0@gmail.com", "Contact", 'email', array('From' => 'kujawskiszymon0@gmail.com',
    'Reply-To' => 'kujawskiszymon0@gmail.com',
    'X-Mailer' => 'PHP/' . phpversion()));
    $this->addContent('message', 'Thank You');
    $this->finish(self::CODE_SUCCESS, Status::OK);
  }
}
