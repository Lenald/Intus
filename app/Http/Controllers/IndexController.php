<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\JsonErrorResponse;
use App\Models\Link;
use App\Repositories\LinkRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __construct(
        private readonly LinkRepositoryInterface $repository
    ) {
    }

    public function index(): View
    {
        return view('index');
    }

    public function save(Request $request): JsonResponse
    {
        $url = $request->get('url');

        try {
            //google api call should be here, but i have no api key
            //to get api key i need google console profile
            //to get google console profile (even for free trial i need to link a credit card, which is not inder sanctions
            //i have no such card :C

            $link = $this->repository->getByUrlOrCreate($url);
        } catch (\Exception) {
            return new JsonErrorResponse('Something went wrong during link creation. Try again.');
        }

        $link->setHash($_SERVER['APP_URL'] . '/' . $link->getHash());

        return new JsonResponse($link->toArray());
    }
}
