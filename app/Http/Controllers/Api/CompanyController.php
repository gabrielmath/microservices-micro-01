<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $repository;
    protected $evaluationService;

    public function __construct(Company $model, EvaluationService $evaluationService)
    {
        $this->repository = $model;
        $this->evaluationService = $evaluationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
//        $companies = $this->repository->with(['category'])->paginate();
        $companies = $this->repository->getCompanies($request->get('filter', ''));

        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return CompanyResource
     */
    public function store(CompanyRequest $request): CompanyResource
    {
        $company = $this->repository->create($request->validated());

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     * @return CompanyResource
     */
    public function show(string $uuid): CompanyResource
    {
        $company = $this->repository->where('uuid', $uuid)->with(['category'])->firstOrFail();

        dd($this->evaluationService->getEvaluationCompany($uuid));

        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyRequest $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyRequest $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

        $company->update($request->validated());

        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $uuid)
    {
        $company = $this->repository->where('uuid', $uuid)->firstOrFail();

        $company->delete();

        return response()->json([], 204);
    }
}
