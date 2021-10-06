<?php

namespace App\Core\Auth;

use App\Core\Auth\Billing;

/**
 * Represents the user
 *
 * @author  Pomianowski <kontakt@rapiddev.pl>
 * @license GPL-3.0 https://www.gnu.org/licenses/gpl-3.0.txt
 * @since   1.1.0
 */
final class User
{
  private int $id = 0;

  private int $role = 0;

  private int $type = 0;

  private string $uuid = '';

  private string $email = '';

  private string $name = '';

  private string $displayName = '';

  private string $image = '';

  private string $password = '';

  private string $cookieToken = '';

  private string $sessionToken = '';

  private string $timezone = '';

  private string $createdAt = '';

  private string $lastLogin = '';

  private string $lastUpdate = '';

  private Billing $billing;

  public function __construct(int $id = 0)
  {
    $this->billing = new Billing($id);
  }

  public function update(): bool
  {
    // TODO: Database update
    return false;
  }

  /**
   * Checks whether the entered password matches the user's password.
   */
  public function comparePassword(string $password): bool
  {
    // TODO: if ($this->password)
    return true;
  }

  /**
   * Create a user instance from an associative array.
   */
  public static function build(array $properties): self
  {
    $billing = Billing::build([
      'email' => $properties['email'] ?? ''
    ]);

    return (new self())
      ->setId($properties['id'] ?? 0)
      ->setRole($properties['role'] ?? 1)
      ->setType($properties['type'] ?? 1)
      ->setUuid($properties['uuid'] ?? '')
      ->setEmail($properties['email'] ?? '')
      ->setName($properties['name'] ?? '')
      ->setDisplayName($properties['display_name'] ?? '')
      ->setImage($properties['image'] ?? '')
      ->setPassword($properties['password'] ?? '')
      ->setTimezone($properties['timezone'] ?? 'UTC')
      ->setBilling($billing);
  }

  private function buildFromDatabase(): bool
  {
    // TODO:
    return false;
  }


  public function isValid(): bool
  {
    return true;
  }

  /**
   * Just a shorter wrapper for \App\Core\Auth\User::getId()
   */
  public function id(): int
  {
    return $this->getId();
  }

  public function setId(int $id): self
  {
    $this->id = $id;

    return $this;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setRole(int $role): self
  {
    $this->role = $role;

    return $this;
  }

  public function getRole(): int
  {
    return $this->role;
  }

  public function setType(int $type): self
  {
    $this->type = $type;

    return $this;
  }

  public function getType(): int
  {
    return $this->type;
  }

  public function setUUID(string $uuid): self
  {
    $this->uuid = $uuid;

    return $this;
  }

  public function getUUID(): string
  {
    return $this->uuid;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setDisplayName(string $displayName): self
  {
    $this->displayName = $displayName;

    return $this;
  }

  public function getDisplayName(): string
  {
    return $this->displayName;
  }

  public function setImage(string $image): self
  {
    $this->image = $image;

    return $this;
  }

  public function getImage(): string
  {
    return $this->image;
  }

  public function setTimezone(string $timezone): self
  {
    $this->timezone = $timezone;

    return $this;
  }

  public function getTimezone(): string
  {
    return $this->timezone;
  }

  public function getCreatedAt(): string
  {
    return $this->createdAt;
  }

  public function getLastLogin(): string
  {
    return $this->lastLogin;
  }

  public function getLastUpdate(): string
  {
    return $this->lastUpdate;
  }

  public function setBilling(Billing $billing): self
  {
    $this->billing = $billing;

    return $this;
  }

  public function getBilling(): Billing
  {
    return $this->billing;
  }

  private function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }
}