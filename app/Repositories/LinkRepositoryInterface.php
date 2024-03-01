<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Link;

interface LinkRepositoryInterface
{
    public const TABLE_NAME = 'links';

    public const COLUMN_ID = 'id';
    public const COLUMN_URL = 'url';
    public const COLUMN_HASH = 'hash';

    public function getByUrlOrCreate(string $url): Link;
    public function getByHash(string $hash): Link;
}
