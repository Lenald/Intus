<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\NoSuchEntityException;
use App\Models\Link;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;

class LinkRepository implements LinkRepositoryInterface
{
    private Hashids $hashGenerator;

    public function __construct()
    {
        $this->hashGenerator = new Hashids(minHashLength: 6);
    }

    public function getByUrlOrCreate(string $url): Link
    {
        $link = Link::where(self::COLUMN_URL, '=', $url)->first();

        return $link ?? $this->create($url);
    }

    public function getByHash(string $hash): Link
    {
        $link = Link::where(self::COLUMN_HASH, '=', $hash)->firstOrFail();

        if (!$link) {
            throw new NoSuchEntityException();
        }

        return $link;
    }

    private function create(string $url): Link
    {
        DB::beginTransaction();

        $last = Link::orderByDesc(self::COLUMN_ID)->first();

        $link = new Link();
        $link->setUrl($url);
        $link->setId($last?->getId() + 1);
        $link->setHash($this->hashGenerator->encode($link->getId()));

        try {
            DB::table(self::TABLE_NAME)
                ->insert($link->toArray());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }

        return $link;
    }
}
