<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use function PHPUnit\Framework\assertJson;

class TodoTest extends TestCase
{
    use DatabaseMigrations;

    public function test_Todos(): void
    {
        Todo::factory()->create();
        $response = $this->get('/api/todos');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll('message', 'success', 'data')
                    ->has('data', 1, function (AssertableJson $json) {
                        $json->hasAll(['id', 'name', 'created_at', 'updated_at', 'completed', 'category_id']);
                    });
            });

    }
//
    public function test_Category(): void
    {
        Todo::factory()->create();
        Category::factory()->create();

        $response = $this->get('/api/todos/1');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['id', 'name', 'created_at', 'updated_at', 'completed', 'category']);
            });
    }
//}

//    public function test_CreateTodo(): void
//    {
//        $testData = ['name' => 'TestTodo', 'category_id' => ];
//        $response = $this->postJson('/api/todos', $testData);
//
//        $response->assertStatus(200)
//            ->assertJson(function (AssertableJson $json) {
//                $json->hasAll('message', 'success');
//            });
//
//        $this->assertDatabaseHas('todos', $testData);
//    }

}

