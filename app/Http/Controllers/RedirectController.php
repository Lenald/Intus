<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\NoSuchEntityException;
use App\Repositories\LinkRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RedirectController extends Controller
{
    public function __construct(
        private readonly LinkRepositoryInterface $repository
    ) {
    }

    public function match(Request $request): RedirectResponse
    {
        $hash = $request->url();

        try {
            $link = $this->repository->getByHash($hash);
        } catch (NoSuchEntityException) {
            throw new HttpException(404);
        }

        return new RedirectResponse($link->getUrl(), 307);
    }
}
