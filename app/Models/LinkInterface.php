<?php
declare(strict_types=1);

namespace App\Models;

interface LinkInterface
{
    public function getUrl(): ?string;
    public function setUrl(string $url): void;

    public function getHash(): ?string;
    public function setHash(string $hash): void;
}
