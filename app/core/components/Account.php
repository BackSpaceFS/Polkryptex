<?php

/**
 * @package   Polkryptex
 *
 * @copyright Copyright (c) 2021 - Kacper J., Pawel L., Filip S., Szymon K., Leszek P.
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace App\Core\Components;

use \DateTime;
use App\Core\Registry;

/**
 * @author Leszek P.
 */
final class Account
{
    private ?User $currentUser = null;

    private array $roles = [];

    public function currentUser(): User
    {
        if ($this->currentUser !== null) {
            return $this->currentUser;
        }

        $userSession = Registry::get('Session')->getSection('User');

        if (!isset($userSession->id) || !isset($userSession->token)) {
            return new User();
        }

        $this->currentUser = \App\Core\Components\User::fromId(intval($userSession->id));

        return $this->currentUser;
    }

    public function signIn(User $user, string $cookieToken): void
    {
        if (!$user->isValid()) {
            return;
        }

        $userSession = Registry::get('Session')->getSection('User');
        $token = Crypter::salter(32);

        $userSession->loggedIn = true;
        $userSession->id = $user->getId();
        $userSession->token = $token;

        Query::setUserToken($user->getId(), Crypter::encrypt($token, 'session'));
        Query::setCookieToken($user->getId(), Crypter::encrypt($cookieToken, 'cookie'));
        Query::updateLastLogin($user->getId());
        
        $userSession->setExpiration('10 minutes');
        Registry::get('Session')->regenerateId();
    }

    public function isLoggedIn(): bool
    {
        $user = $this->currentUser();

        if (!$user->isValid()) {
            return false;
        }

        $userSession = Registry::get('Session')->getSection('User');
        $userCookie = Registry::get('Request')->getCookie('user');

        if(null === $userCookie || null === $userSession->token)
        {
            return false;
        }

        //Kill user session after 10 minutes of inactivity
        $userSession->setExpiration('10 minutes');
        Registry::get('Session')->regenerateId();

        return $user->checkSessionToken($userSession->token) && $user->checkCookieToken($userCookie);
    }

    public function signOut(): void
    {
        Registry::get('Response')->setCookie('user', '', '100 days', '/', null, true, true);
        Registry::get('Session')->getSection('User')->remove();
        Registry::get('Session')->destroy();
    }

    public function getRoles(): array
    {
        if (isset($this->roles)) {
            return $this->roles;
        }

        $dbRoles = Query::getRoles();

        $this->roles = [];
        foreach ($dbRoles as $key => $role) {
            $this->roles[] = [
                'id' => $role['role_id'],
                'name' => $role['role_name'],
                'permissions' => json_decode($role['role_permissions'])
            ];
        }

        return $this->roles;
    }

    public static function hasPermission(string $permission): bool
    {
        return true;
    }
}