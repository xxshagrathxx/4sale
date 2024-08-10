<?php

namespace Tests\Feature;

use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DB;

class ProviderControllerTest extends TestCase
{
    const URL = '/api/v1/users?';
    /**
     * A basic feature test example.
     */

    public function truncateTable()
    {
        DB::table('providers')->truncate();
    }

    public function test_it_applies_provider_filter_correctly()
    {
        $this->truncateTable();

        Provider::factory()->create([
            'balance' => 200,
            'currency' => 'USD',
            'email' => 'example@example.com',
            'status' => 'decline',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d1',
            'reference' => 'Provider1',
        ]);

        Provider::factory()->create([
            'balance' => 200,
            'currency' => 'USD',
            'email' => 'example@example.com',
            'status' => 'decline',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d2',
            'reference' => 'Provider2',
        ]);

        $response = $this->getJson(self::URL.'provider=Provider1');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonFragment(['reference' => 'Provider1']);
    }

    public function test_it_applies_currency_filter_correctly()
    {
        $this->truncateTable();

        Provider::factory()->create([
            'balance' => 200,
            'currency' => 'USD',
            'email' => 'example@example.com',
            'status' => 'decline',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d1',
            'reference' => 'Provider1',
        ]);

        Provider::factory()->create([
            'balance' => 200,
            'currency' => 'EUR',
            'email' => 'example@example.com',
            'status' => 'decline',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d2',
            'reference' => 'Provider2',
        ]);

        $response = $this->getJson(self::URL.'currency=USD');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonFragment(['currency' => 'USD']);
    }

    public function test_it_applies_balance_range_filter_correctly()
    {
        $this->truncateTable();

        Provider::factory()->create([
            'balance' => 500,
            'currency' => 'USD',
            'email' => 'example@example.com',
            'status' => 'decline',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d1',
            'reference' => 'Provider1',
        ]);

        Provider::factory()->create([
            'balance' => 1500,
            'currency' => 'EUR',
            'email' => 'example@example.com',
            'status' => 'decline',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d2',
            'reference' => 'Provider2',
        ]);

        $response = $this->getJson(self::URL.'balanceMin=1000&balanceMax=2000');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonFragment(['balance' => 1500]);
    }

    public function test_it_applies_status_filter_correctly()
    {
        $this->truncateTable();

        Provider::factory()->create([
            'balance' => 500,
            'currency' => 'USD',
            'email' => 'example@example.com',
            'status' => 'decline',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d1',
            'reference' => 'Provider1',
        ]);

        Provider::factory()->create([
            'balance' => 1500,
            'currency' => 'EUR',
            'email' => 'example@example.com',
            'status' => 'authorised',
            'registration_date' => '2022-02-01',
            'identification' => '4fc2-a8d2',
            'reference' => 'Provider2',
        ]);

        $response = $this->getJson(self::URL.'statusCode=authorised');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonFragment(['status' => 'authorised']);
    }

    
}
