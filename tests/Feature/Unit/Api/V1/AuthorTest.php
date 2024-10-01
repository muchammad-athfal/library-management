<?php

namespace Tests\Feature\Unit\Api\V1;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_author()
    {
        $author = Author::factory()->create();
        $this->assertDatabaseHas('authors', ['name' => $author->name]);
    }

    /** @test */
    public function it_can_retrieve_an_author()
    {
        $author = Author::factory()->create();
        $this->assertNotNull(Author::find($author->id));
    }

    /** @test */
    public function it_can_update_an_author()
    {
        $author = Author::factory()->create();
        $author->update(['name' => 'Updated Name']);

        $this->assertDatabaseHas('authors', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_an_author()
    {
        $author = Author::factory()->create();
        $author->delete();

        $this->assertSoftDeleted('authors', ['id' => $author->id]);
    }

    /** @test */
    public function it_handles_retrieving_non_existent_author()
    {
        $this->assertNull(Author::find(999)); // Assuming 999 doesn't exist
    }

    /** @test */
    public function it_fails_to_create_an_author_without_required_fields()
    {
        $response = $this->postJson('/api/v1/authors', [
            'name' => '', // Missing name
            'bio' => 'Bio goes here',
            'birth_date' => '1980-01-01',
        ]);

        $response->assertStatus(422); // Validation error
    }
}
