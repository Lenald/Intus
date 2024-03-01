<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\LinkRepositoryInterface;
use Hashids\Hashids;

class Link extends Model implements LinkInterface
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = LinkRepositoryInterface::TABLE_NAME;

    /**
     * @var array
     */
    protected $fillable = [
        'hash',
        'url'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    protected int $id;
    protected string $url;
    protected string $hash;

    public function getId(): int
    {
        return (int)$this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getUrl(): ?string
    {
        return (string)$this->attributes['url'];
    }

    public function setUrl(string $url): void
    {
        $this->attributes['url'] = $url;
    }

    public function getHash(): ?string
    {
        return (string)$this->attributes['hash'];
    }

    public function setHash(string $hash): void
    {
        $this->attributes['hash'] = $hash;
    }
}
