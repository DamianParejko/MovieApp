<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Movie;
use App\Models\Comment;

class PostTest extends Authenticated {

    /** @test */
    public function store_post_is_in_database(){
        $movie = Movie::factory()->create();
        
        $post = Post::factory()->create([
            'user_id' => $this->user->id,
            'movie_id' => $movie->id,
            'content' => 'I like it',
        ]);
        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'movie_id' => $post->movie_id,
            'content' => 'I like it',
        ]);
    }

    /** @test */
    public function show_post_in_route(){
        $movie = Movie::factory()->create();

        $post = Post::factory()->create([
            'content' => 'I like it',
            'movie_id' => $movie->id
        ]);

        $response = $this->get('post/' . $post->id);
        
        $response->assertStatus(200)->assertSeeText('I like it');
    }

     /** @test */
    public function validation_store_post_when_field_content_is_empty(){
        $movie = Movie::factory()->create();

        $response = $this->post('post/' . $movie->id, [
            'content' => ''
        ]);
        $response->assertSessionhasErrors('content');
    }
    
    /** @test */
    public function validation_store_post_without_minimum_characters_in_field_content(){
        $movie = Movie::factory()->create();

        $response = $this->post('post/' . $movie->id, [
            'content' => 't'
        ]);
        
        $response->assertSessionhasErrors('content');
    }

    /** @test */
    public function validation_store_post_with_minimum_characters_in_field_content(){
        $movie = Movie::factory()->create();
        
        $response = $this->post('post/' . $movie->id, [
            'content' => 'to'
        ]);

        $response->assertSessionDoesnthaveErrors('content');
    }

    /** @test */
    public function if_logged_user_is_not_author_cannot_update_post(){
        $author = User::factory()->create();
        $notAuthor = User::factory()->create();
        $movie = Movie::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $author->id,
            'movie_id' => $movie->id
        ]);

        $response = $this->actingAs($notAuthor)->put('post/' . $post->id, [
            'user_id' => $this->user->id,
            'content' => 'I try edit',
        ]);

        $response->assertForbidden();
    }

     /** @test */
    public function if_logged_user_is_author_can_update_post(){
        $author = User::factory()->create();
        $movie = Movie::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $author->id,
            'movie_id' => $movie->id
        ]);

        $this->actingAs($author)->put('post/' . $post->id, [
            'user_id' => $author->id,
            'content' => 'I try edit',
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $author->id,
            'movie_id' => $post->movie_id,
            'content' => 'I try edit',
        ]);
    }

    /** @test */
    public function author_cannnot_update_post_if_post_field_is_empty(){
        $author = User::factory()->create();
        $movie = Movie::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $author->id,
            'movie_id' => $movie->id
        ]);

        $response = $this->actingAs($author)->put('post/' . $post->id, [
            'user_id' => $author->id,
            'content' => null,
        ]);

        $response->assertSessionhasErrors('content');   
    }

    /** @test */
    public function author_cannot_update_post_if_there_are_less_characters_than_required(){
        $author = User::factory()->create();
        $movie = Movie::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $author->id,
            'movie_id' => $movie->id
        ]);

        $response = $this->actingAs($author)->put('post/' . $post->id, [
            'user_id' => $author->id,
            'content' => 'i',
        ]);

        $response->assertSessionhasErrors('content');
    }

    /** @test */
    public function author_can_update_post_if_number_characters_has_minimum_requirements(){
        $author = User::factory()->create();
        $movie = Movie::factory()->create();
        
        $post = Post::factory()->create([
            'user_id' => $author->id,
            'movie_id' => $movie->id
        ]);

        $response = $this->actingAs($author)->put('post/' . $post->id, [
            'user_id' => $author->id,
            'content' => 'ii',
        ]);

        $response->assertSessionDoesnthaveErrors('content');
    }

    /** @test */
    public function if_logged_user_is_not_author_cannot_delete_post(){
        $author = User::factory()->create();
        $notAuthor = User::factory()->create();
        $movie = Movie::factory()->create();
        
        $post = Post::factory()->create([
            'user_id' => $author->id,
            'movie_id' => $movie->id
        ]);

        $response = $this->actingAs($notAuthor)->delete('post/' . $post->id);

        $response->assertForbidden();
    }

    /** @test */
    public function if_logged_user_is_author_can_delete_post(){
        $author = User::factory()->create();
        $notAuthor = User::factory()->create();
        $movie = Movie::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $author->id,
            'movie_id' => $movie->id
        ]);

        $this->actingAs($author)->delete('post/' . $post->id);
        
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id
        ]);
    }

    /** @test */
    public function show_comment_bottom_post(){
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'comment' => 'test comment'
        ]);
        
        $response = $this->get('post/' . $comment->post_id);
        $response->assertStatus(200)->assertSeeText('test comment');
    }
}