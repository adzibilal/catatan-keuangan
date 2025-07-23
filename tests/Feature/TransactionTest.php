<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guest_redirected_from_transactions()
    {
        $response = $this->get('/transactions');
        $response->assertRedirect('/login');
    }

    #[Test]
    public function user_can_access_transactions()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/transactions');
        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_create_transaction()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/transactions', [
            'description' => 'Bayar Listrik',
            'amount' => 100000,
            'type' => 'expense'
        ]);

        $response->assertRedirect('/transactions');
        $this->assertDatabaseHas('transactions', [
            'description' => 'Bayar Listrik',
            'amount' => 100000,
            'type' => 'expense',
            'user_id' => $user->id
        ]);
    }
} 