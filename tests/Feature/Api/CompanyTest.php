<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * @var string $endpoint
     */
    protected $endpoint = '/companies';

    /**
     * Get all companies
     *
     * @return void
     */
    public function test_get_all_companies(): void
    {
        $url = $this->endpoint;
        Company::factory()->count(6)->create();

        $response = $this->getJson($url);
        $response->assertStatus(200);
    }

    /**
     * Get Total Count data for all companies
     *
     * @return void
     */
    public function test_get_total_count_all_companies(): void
    {
        $url = $this->endpoint;
        Company::factory()->count(6)->create();

        $response = $this->getJson($url);
//        $response->dump();
        $response->assertJsonCount(6, 'data');
    }

    /**
     * Error get single company with fake-url
     *
     * @return void
     */
    public function test_error_get_single_company(): void
    {
        $company = 'fake-uuid';
        $url = "{$this->endpoint}/{$company}";

        $response = $this->getJson($url);
        $response->assertStatus(404);
    }

    /**
     * Get single company with created company
     *
     * @return void
     */
    public function test_get_single_company(): void
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $url = "{$this->endpoint}/{$company->uuid}";

        $response = $this->getJson($url);
        $response->assertStatus(200);
    }

    /**
     * Validation store company with error
     *
     * @return void
     */
    public function test_validation_store_company(): void
    {
        $url = $this->endpoint;
        $company = [
            'category_id' => '',
            'name'        => 'Gabriel Silva',
            'whatsapp'    => '',
            'email'       => 'gabrielmath@hotmail.com'
        ];

        $response = $this->postJson($url, $company);
//        $response->dump();
        $response->assertStatus(422);
    }

    /**
     * Store company
     *
     * @return void
     */
    public function test_store_company(): void
    {
        $url = $this->endpoint;
        $company = [
            'category_id' => Category::factory()->create()->id,
            'name'        => 'Gabriel Silva',
            'whatsapp'    => '(18) 996377303',
            'email'       => 'gabrielmath@hotmail.com'
        ];

        $response = $this->postJson($url, $company);
//        $response->dump();
        $response->assertStatus(201);
    }

    /**
     * Error Update company url link
     *
     * @return void
     */
    public function test_error_update_company(): void
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $dataUpdate = [
            'category_id' => $company->category_id,
            'name'        => 'Gabriel Silva',
            'whatsapp'    => '(18) 996377303',
            'email'       => 'gabrielmath@hotmail.com'
        ];

        $companyUrlFake = "/fake-uuid";
        $urlFake = "{$this->endpoint}/{$companyUrlFake}";

        $response = $this->putJson($urlFake, $dataUpdate);
        $response->assertStatus(404);
    }

    /**
     * Validated Update company with error
     *
     * @return void
     */
    public function test_validated_update_company(): void
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $url = "{$this->endpoint}/{$company->uuid}";

        $response = $this->putJson($url, []);
        $response->assertStatus(422);
    }

    /**
     * Update company
     *
     * @return void
     */
    public function test_update_company(): void
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $dataUpdate = [
            'category_id' => $company->category_id,
            'name'        => 'Gabriel Silva',
            'whatsapp'    => '(18) 996377303',
            'email'       => 'gabrielmath@hotmail.com'
        ];

        $url = "{$this->endpoint}/{$company->uuid}";

        $response = $this->putJson($url, $dataUpdate);
        $response->assertStatus(200);
    }

    /**
     * Error delete company url link
     *
     * @return void
     */
    public function test_error_delete_company(): void
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $companyUrlFake = "/fake-uuid";
        $urlFake = "{$this->endpoint}/{$companyUrlFake}";

        $response = $this->deleteJson($urlFake);
        $response->assertStatus(404);
    }

    /**
     * Delete company
     *
     * @return void
     */
    public function test_delete_company(): void
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        $url = "{$this->endpoint}/{$company->uuid}";

        $response = $this->deleteJson($url);
        $response->assertStatus(204);
    }
}
