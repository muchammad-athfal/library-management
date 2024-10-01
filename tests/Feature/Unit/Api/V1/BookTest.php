<?php

namespace Tests\Feature\Unit\Api\V1;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_book()
    {
        $book = Book::factory()->create();
        $this->assertDatabaseHas('books', ['title' => $book->title]);
    }

    /** @test */
    public function it_can_retrieve_a_book()
    {
        $book = Book::factory()->create();

        $this->assertNotNull(Book::find($book->id));
    }

    /** @test */
    public function it_can_update_a_book()
    {
        $book = Book::factory()->create();
        $book->update(['title' => 'Updated Title']);

        $this->assertDatabaseHas('books', ['title' => 'Updated Title']);
    }

    /** @test */
    public function it_can_delete_a_book()
    {
        $book = Book::factory()->create();
        $book->delete();

        $this->assertSoftDeleted('books', ['id' => $book->id]);
    }

    /** @test */
    public function it_handles_retrieving_non_existent_book()
    {
        $this->assertNull(Book::find(999)); // Assuming 999 doesn't exist
    }

    /** @test */
    public function it_fails_to_create_a_book_with_invalid_author_id()
    {
        $response = $this->postJson('/api/v1/books', [
            'title' => 'Test Book',
            'description' => 'Test Description',
            'publish_date' => '2024-01-01',
            'author_id' => 999, // Non-existent author
        ]);

        $response->assertStatus(422); // Validation error
    }
}
