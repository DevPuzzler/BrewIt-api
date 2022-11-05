<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrewCategory\BrewCategoryExistsAndBelongsToUserRequest;
use App\Http\Requests\BrewCategory\CreateBrewCategoryRequest;
use App\Http\Requests\BrewCategory\UpdateBrewCategoryRequest;
use App\Http\Responses\JSON\DefaultErrorResponse;
use App\Http\Responses\JSON\DeleteResponse;
use App\Http\Responses\JSON\GetResponse;
use App\Http\Responses\JSON\PatchResponse;
use App\Http\Responses\JSON\PostResponse;
use App\Http\Services\BrewCategory\BrewCategoryService;
use App\Interfaces\Responses\JsonResponseInterface;
use App\Models\BrewCategory;
use App\Tools\ValueObjects\Queries\BrewCategory\CreateBrewCategoryQuery;
use App\Tools\ValueObjects\Queries\BrewCategory\UpdateBrewCategoryQuery;
use Exception;

class BrewCategoryController extends Controller
{
    public function __construct(
        protected readonly BrewCategoryService $brewCategoryService
    ) {}

    public function getCollectionForUser(): JsonResponseInterface
    {
        try {
            $user = auth()->user();

            return GetResponse::create(
                $this->brewCategoryService->getCollectionForUser( $user )->toArray()
            );
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }

    public function getById( BrewCategoryExistsAndBelongsToUserRequest $request ): JsonResponseInterface
    {
        try {
            return GetResponse::create(
                $this->brewCategoryService->getById(
                    $request->validated(BrewCategory::COLUMN_ID)
                )->toArray()
            );
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }

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

    public function update( UpdateBrewCategoryRequest $request ): JsonResponseInterface
    {
        try {
            $this->brewCategoryService->update(
                new UpdateBrewCategoryQuery(
                    ...$request->validated()
                )
            );

            return PatchResponse::create();
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }

    public function delete( BrewCategoryExistsAndBelongsToUserRequest $request ): JsonResponseInterface
    {
        try {
            $this->brewCategoryService->delete($request->validated(BrewCategory::COLUMN_ID));

            return DeleteResponse::create();
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }
}
