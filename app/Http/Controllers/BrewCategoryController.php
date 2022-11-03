<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrewCategory\CreateBrewCategoryRequest;
use App\Http\Responses\JSON\DefaultErrorResponse;
use App\Http\Responses\JSON\PostResponse;
use App\Http\Services\BrewCategory\BrewCategoryService;
use App\Interfaces\Responses\JsonResponseInterface;
use App\Tools\ValueObjects\Queries\BrewCategory\CreateBrewCategoryQuery;
use Exception;

class BrewCategoryController extends Controller
{
    public function __construct(
        protected readonly BrewCategoryService $brewCategoryService
    ) {}

    public function create( CreateBrewCategoryRequest $request ): JsonResponseInterface
    {
        try {
            $user = auth()->user();

            return PostResponse::create(
                $this->brewCategoryService->create(
                new CreateBrewCategoryQuery(
                    $user,
                    ...$request->validated()
                )
            )->toArray());
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }

    }
}
