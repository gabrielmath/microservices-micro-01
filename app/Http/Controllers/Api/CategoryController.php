<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(Category $model)
    {
        $this->repository = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = $this->repository->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        $category = $this->repository->create($request->validated());

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param string $url
     * @return CategoryResource
     */
    public function show(string $url): CategoryResource
    {
        $category = $this->repository->where('url', $url)->firstOrFail();

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param string $url
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, string $url): \Illuminate\Http\JsonResponse
    {
        $category = $this->repository->where('url', $url)->firstOrFail();

        $category->update($request->validated());

        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $url
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $url): \Illuminate\Http\JsonResponse
    {
        $category = $this->repository->where('url', $url)->firstOrFail();

        $category->delete();

        return response()->json([], 204);
    }
}
