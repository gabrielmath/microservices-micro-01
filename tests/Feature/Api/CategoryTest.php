<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @var string $endpoint
     */
    protected $endpoint = '/categories';

    /**
     * Get all categories
     *
     * @return void
     */
    public function test_get_all_categories(): void
    {
        $url = $this->endpoint;
        Category::factory()->count(6)->create();

        $response = $this->getJson($url);
        $response->assertStatus(200);
    }

    /**
     * Get Total Count data for all categories
     *
     * @return void
     */
    public function test_get_total_count_all_categories(): void
    {
        $url = $this->endpoint;
        Category::factory()->count(6)->create();

        $response = $this->getJson($url);
//        $response->dump();
        $response->assertJsonCount(6, 'data');
    }

    /**
     * Error get single category with fake-url
     *
     * @return void
     */
    public function test_error_get_single_category(): void
    {
        $category = 'fake-url';
        $url = "{$this->endpoint}/{$category}";

        $response = $this->getJson($url);
        $response->assertStatus(404);
    }

    /**
     * Get single category with created category
     *
     * @return void
     */
    public function test_get_single_category(): void
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $url = "{$this->endpoint}/{$category->url}";

        $response = $this->getJson($url);
        $response->assertStatus(200);
    }

    /**
     * Validation store category with error
     *
     * @return void
     */
    public function test_validation_store_category(): void
    {
        $url = $this->endpoint;
        $category = [
            'title'       => '',
            'description' => ''
        ];

        $response = $this->postJson($url, $category);
//        $response->dump();
        $response->assertStatus(422);
    }

    /**
     * Store category
     *
     * @return void
     */
    public function test_store_category(): void
    {
        $url = $this->endpoint;
        $category = [
            'title'       => 'Categoria 1',
            'description' => 'Uma super categoria'
        ];

        $response = $this->postJson($url, $category);
//        $response->dump();
        $response->assertStatus(201);
    }

    /**
     * Error Update category url link
     *
     * @return void
     */
    public function test_error_update_category(): void
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $dataUpdate = [
            'title'       => 'Categoria updated',
            'description' => 'Uma super categoria editada'
        ];

        $categoryUrlFake = "/fake-url";
        $urlFake = "{$this->endpoint}/{$categoryUrlFake}";

        $response = $this->putJson($urlFake, $dataUpdate);
        $response->assertStatus(404);
    }

    /**
     * Validated update category with error
     *
     * @return void
     */
    public function test_validated_update_category(): void
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $url = "{$this->endpoint}/{$category->url}";

        $response = $this->putJson($url, []);
        $response->assertStatus(422);
    }

    /**
     * Update category
     *
     * @return void
     */
    public function test_update_category(): void
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $dataUpdate = [
            'title'       => 'Categoria updated',
            'description' => 'Uma super categoria editada'
        ];

        $url = "{$this->endpoint}/{$category->url}";

        $response = $this->putJson($url, $dataUpdate);
        $response->assertStatus(200);
    }

    /**
     * Error delete category url link
     *
     * @return void
     */
    public function test_error_delete_category(): void
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $categoryUrlFake = "/fake-url";
        $urlFake = "{$this->endpoint}/{$categoryUrlFake}";

        $response = $this->deleteJson($urlFake);
        $response->assertStatus(404);
    }

    /**
     * Delete category
     *
     * @return void
     */
    public function test_delete_category(): void
    {
        /** @var Category $category */
        $category = Category::factory()->create();

        $url = "{$this->endpoint}/{$category->url}";

        $response = $this->deleteJson($url);
        $response->assertStatus(204);
    }
}
