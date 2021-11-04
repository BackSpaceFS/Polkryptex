<?php

namespace App\Core\Data;

use App\Core\Facades\{DB, Request};
use App\Core\Auth\Account;

/**
 * Allows to save and read statistical data from the database.
 *
 * @author  Pomianowski <kontakt@rapiddev.pl>
 * @license GPL-3.0 https://www.gnu.org/licenses/gpl-3.0.txt
 * @since   1.1.0
 */
final class Statistics
{
  public const TYPE_PAGE = 'page';

  public const TYPE_REQUEST = 'request';

  public const TYPE_TRANSACTION = 'transaction';

  public const TYPE_USER = 'user';

  private bool $opened = false;

  private array $tags = [];

  private array $types = [];

  public function __construct(bool $opened = false)
  {
    $this->opened = $opened;

    if (!$this->opened) {
      return;
    }

    $this->fetchTags(DB::table('statistics_tags')->get()->all() ?? []);
    $this->fetchTypes(DB::table('statistics_types')->get()->all() ?? []);

    ray([
      'tags' => $this->tags,
      'types' => $this->types
    ]);
  }

  /**
   * Writes a new record to the database.
   */
  public function push(string $type, string $tag, string $ua = null): bool
  {
    if (!$this->opened) {
      return false;
    }

    $user = Account::current();

    return (bool) DB::table('statistics')->insert([
      'statistic_tag' => $this->getTagId($tag),
      'statistic_type' => $this->getTypeId($type),
      'ua' => $ua,
      'user_id' => !empty($user) ? $user->getId() : null,
      'ip' => Request::ip()
    ]);
  }

  /**
   * Gets information about whether statistics are currently being saved.
   */
  public function isOpened(): bool
  {
    return $this->opened;
  }

  private function getTypeId(string $type): int
  {
    foreach ($this->types as $singleType) {
      if ($singleType['name'] === $type) {
        return $singleType['id'];
      }
    }

    $insertedId = DB::table('statistics_types')->insertGetId([
      'name' => $type
    ]);

    $this->types[] = [
      'id' => $insertedId,
      'name' => $type
    ];

    return $insertedId;
  }

  private function getTagId(string $tag): int
  {
    foreach ($this->tags as $singleTag) {
      if ($singleTag['name'] === $tag) {
        return $singleTag['id'];
      }
    }

    $insertedId = DB::table('statistics_tags')->insertGetId([
      'name' => $tag
    ]);

    $this->tags[] = [
      'id' => $insertedId,
      'name' => $tag
    ];

    return $insertedId;
  }

  private function fetchTags(array $tags = []): self
  {
    foreach ($tags as $tag) {
      if (isset($tag->id) && isset($tag->name)) {
        $this->tags[] = [
          'id' => $tag->id,
          'name' => $tag->name
        ];
      }
    }

    return $this;
  }

  private function fetchTypes(array $types = []): self
  {
    foreach ($types as $type) {
      if (isset($type->id) && isset($type->name)) {
        $this->types[] = [
          'id' => $type->id,
          'name' => $type->name
        ];
      }
    }

    return $this;
  }
}
