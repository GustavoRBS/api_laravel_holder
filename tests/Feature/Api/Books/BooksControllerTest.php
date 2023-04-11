<?php

namespace Tests\Feature\Api\Transaction;

use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testTransactionIndex()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', route('transactions.index'), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testTransactionShow()
    {
        $user = User::factory()->create();
        $transaction = transaction::factory()->create();

        $this->json('GET', route('transaction.show', $transaction->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testTransactionStore()
    {
        $user = User::factory()->create();

        $data = [
            'title' => "title #2",
            'price' => "price #2",
            'author' => "author #2",
            'editor'=> "editor #2",
        ];

        $response = $this->json('POST', route('books.store'), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(201);
	}

    public function testBookUpdate()
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();

        $data = [
            'id' => 1,
            'title' => "title #1 update",
            'price' => "price #1 update",
            'author' => "author #1 update",
            'editor'=> "editor #1 update",
        ];
        $this->json('PUT', route('books.update', $book->id), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testBookDelete()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $this->json('DELETE', route('books.destroy', $book->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(204);
    }
}
