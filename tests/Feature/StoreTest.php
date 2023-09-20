<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Store;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    public function test_fetching_all_user_stores()
    {
        $user = $this->generateUser();
        $this->generateStore($user->id, 20);


        $response = $this->actingAs($user)
            ->getJson(route('user.stores', $user->id))
            ->assertStatus(200);

        $response->assertJsonStructure(
            ['*' =>
            [
                'id',
                'name',
                'address',
                'user_id'
            ]]
        );
    }

    public function test_user_can_create_store()
    {
        $user = $this->generateUser();

        $store = $this->createStore($user->id);

        $this->actingAS($user)
            ->postJson(route('user.create-store', $store))
            ->assertCreated();
        $this->assertDatabaseHas('stores', $store);
    }

    public function test_validation_for_required_store_name()
    {
        $user = $this->generateUser();
        $store = $this->createStore($user->id);

        $store['name'] = null;

        $response = $this->actingAs($user)
            ->postJson(route('user.create-store', $store))
            ->assertUnprocessable();
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_validation_for_required_store_address()
    {
        $user = $this->generateUser();
        $store = $this->createStore($user->id);

        $store['address'] = null;

        $response = $this->actingAs($user)
            ->postJson(route('user.create-store'), $store)
            ->assertUnprocessable();

        $response->assertJsonValidationErrors(['address']);
    }

    public function test_validation_for_required_store_user_id()
    {
        $user = $this->generateUser();
        $store = $this->createStore($user->id);

        $store['user_id'] = null;

        $response = $this->actingAs($user)
            ->postJson(route('user.create-store'), $store)
            ->assertUnprocessable();

        $response->assertJsonValidationErrors(['user_id']);
    }

    public function test_updating_store_data()
    {
        $user = $this->generateUser();
        $store = Store::factory()->create(['user_id' => $user->id]);

        $updatedData = [
            'name' => 'Updated Data',
            'address' => 'Updated Address'
        ];
        $this->actingAs($user)
            ->putJson(route('user.update-store', $store->id), $updatedData)
            ->assertOk();
        $this->assertDatabaseHas('stores', $updatedData);
    }

    public function test_delete_user_store()
    {
        $user = $this->generateUser();
        $store = Store::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->deleteJson(route('user.delete-store', $store->id))
            ->assertOk();

        $this->assertDatabaseMissing('stores', ['id' => $store->id]);
    }
}
