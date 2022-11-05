<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrewProductCategory\BrewProductCategoryExistsAndBelongsToUserRequest;
use App\Http\Requests\BrewProductCategory\CreateBrewProductCategoryRequest;
use App\Http\Requests\BrewProductCategory\UpdateBrewProductCategoryRequest;
use App\Http\Responses\JSON\DefaultErrorResponse;
use App\Http\Responses\JSON\DeleteResponse;
use App\Http\Responses\JSON\GetResponse;
use App\Http\Responses\JSON\PatchResponse;
use App\Http\Responses\JSON\PostResponse;
use App\Http\Services\BrewProductCategory\BrewProductCategoryService;
use App\Interfaces\Responses\JsonResponseInterface;
use App\Models\BrewProductCategory;
use App\Tools\ValueObjects\Queries\BrewProductCategory\CreateBrewProductCategoryQuery;
use App\Tools\ValueObjects\Queries\BrewProductCategory\UpdateBrewProductCategoryQuery;
use Exception;

class BrewProductCategoryController extends Controller
{
    public function __construct(
        protected readonly BrewProductCategoryService $brewProductCategoryService
    ) {}

    public function getCollectionForUser(): JsonResponseInterface
    {
        try {
            $user = auth()->user();

            return GetResponse::create(
                $this->brewProductCategoryService->getCollectionForUser( $user )->toArray()
            );
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }

    public function getById(BrewProductCategoryExistsAndBelongsToUserRequest $request ): JsonResponseInterface
    {
        try {
            return GetResponse::create(
                $this->brewProductCategoryService->getById(
                    $request->validated(BrewProductCategory::COLUMN_ID)
                )->toArray()
            );
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }

    public function create(CreateBrewProductCategoryRequest $request ): JsonResponseInterface
    {
        try {
            $user = auth()->user();

            return PostResponse::create(
                $this->brewProductCategoryService->create(
                new CreateBrewProductCategoryQuery(
                    $user,
                    ...$request->validated()
                )
            )->toArray());
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }

    public function update(UpdateBrewProductCategoryRequest $request ): JsonResponseInterface
    {
        try {
            $this->brewProductCategoryService->update(
                new UpdateBrewProductCategoryQuery(
                    ...$request->validated()
                )
            );

            return PatchResponse::create();
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }

    public function delete(BrewProductCategoryExistsAndBelongsToUserRequest $request ): JsonResponseInterface
    {
        try {
            $this->brewProductCategoryService->delete($request->validated(BrewProductCategory::COLUMN_ID));

            return DeleteResponse::create();
        } catch ( Exception $e ) {
            return DefaultErrorResponse::createFromException($e);
        }
    }
}
