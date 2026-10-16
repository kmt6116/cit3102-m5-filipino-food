<?php

use App\Models\FilipinoFood;
use App\Models\User;

it('registers a user and returns an access token', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
    ]);

    $response
        ->assertStatus(201)
        ->assertJsonStructure([
            'user' => ['id', 'name', 'email'],
            'token',
        ]);

    expect(User::where('email', 'test@example.com')->exists())->toBeTrue();
});

it('creates and lists foods when authenticated', function () {
    $user = User::factory()->create();
    $token = $user->createToken('api-token')->plainTextToken;

    $createResponse = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson('/api/foods', [
            'name' => 'Chicken Adobo',
            'category' => 'Meals',
            'description' => 'Classic Filipino stew.',
            'price' => 125.50,
            'availability' => true,
        ]);

    $createResponse->assertStatus(201)
        ->assertJsonPath('name', 'Chicken Adobo');

    $listResponse = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson('/api/foods?category=Meals&availability=1');

    $listResponse->assertStatus(200)
        ->assertJsonFragment(['name' => 'Chicken Adobo']);

    expect(FilipinoFood::where('name', 'Chicken Adobo')->exists())->toBeTrue();
});

it('updates and deletes a food item', function () {
    $user = User::factory()->create();
    $token = $user->createToken('api-token')->plainTextToken;

    $food = FilipinoFood::create([
        'name' => 'Lumpia',
        'category' => 'Snacks',
        'description' => 'Crispy spring rolls.',
        'price' => 45.00,
        'availability' => true,
    ]);

    $updateResponse = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson('/api/foods/'.$food->id, [
            'price' => 55.00,
            'availability' => false,
        ]);

    $updateResponse->assertStatus(200)
        ->assertJsonPath('price', '55.00');

    $deleteResponse = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson('/api/foods/'.$food->id);

    $deleteResponse->assertStatus(204);
    expect(FilipinoFood::find($food->id))->toBeNull();
});
