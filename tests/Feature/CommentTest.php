<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentTest extends Authenticated {
    
    /** @test */
    public function store_comment_is_in_database(){
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $post->id
        ]);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
        ]);
    }

    /** @test */
    public function show_comment_in_route(){
        $post = Post::factory()->create();
        
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'comment' => 'test comment route'
        ]);

        $response = $this->get('post/' . $comment->post_id);
        $response->assertStatus(200)->assertSeeText('test comment route');
    }

    /** @test */
    public function validation_store_comment_when_field_comment_is_empty(){
        $post = Post::factory()->create();

        $response = $this->post('comment/' . $post->id, [
            'comment' => null
        ]);

        $response->assertSessionhasErrors('comment');
    }

    /** @test */
    public function validation_store_comment_without_minimum_characters_in_field_comment(){
        $post = Post::factory()->create();

        $response = $this->post('comment/' . $post->id, [
            'comment' => '.'
        ]);
        
        $response->assertSessionhasErrors('comment');
    }

    /** @test */
    public function validation_store_comment_with_minimum_characters_in_field_comment(){
        $post = Post::factory()->create();

        $response = $this->post('comment/' . $post->id, [
            'comment' => 'ok'
        ]);
        
        $response->assertSessionDoesnthaveErrors('comment');
    }
    
    /** @test */
    public function if_logged_user_is_not_author_cannot_update_comment(){
        $author = User::factory()->create();
        $notAuthor = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $author->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($notAuthor)->put('comment/' . $comment->id, [
            'user_id' => $this->user->id,
            'comment' => 'I try edit',
        ]);

        $response->assertForbidden();
    }

    /** @test */
    public function if_logged_user_is_author_can_update_comment(){
        $author = User::factory()->create();
        $notAuthor = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $author->id,
            'post_id' => $post->id
        ]);

        $this->actingAs($author)->put('comment/' . $comment->id, [
            'user_id' => $this->user->id,
            'comment' => 'I try edit',
        ]);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'user_id' => $author->id,
            'post_id' => $post->id,
            'comment' => 'I try edit',
        ]);
    }
    /** @test */
    public function author_cannot_update_comment_if_field_comment_is_empty(){
        $author = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $author->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($author)->put('comment/' . $comment->id, [
            'user_id' => $author->id,
            'comment' => null,
        ]);

        $response->assertSessionhasErrors('comment');
    }
    
    /** @test */
    public function author_cannot_update_comment_if_there_are_less_characters_than_required(){
        $author = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $author->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($author)->put('comment/' . $comment->id, [
            'user_id' => $author->id,
            'comment' => 'i',
        ]);

        $response->assertSessionhasErrors('comment');
    }

    /** @test */
    public function aauthor_can_update_comment_if_number_characters_has_minimum_requirements(){
        $author = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $author->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($author)->put('comment/' . $comment->id, [
            'user_id' => $author->id,
            'comment' => 'ok',
        ]);

        $response->assertSessionDoesnthaveErrors('comment');
    }

    /** @test */
    public function if_logged_user_is_not_author_cannot_delete_comment(){
        $author = User::factory()->create();
        $notAuthor = User::factory()->create();
        $post = Post::factory()->create();
        
        $comment = Comment::factory()->create([
            'user_id' => $author->id,
            'post_id' => $post->id
        ]);

        $response = $this->actingAs($notAuthor)->delete('comment/' . $comment->id);

        $response->assertForbidden();
    }

     /** @test */
     public function if_logged_user_is_author_can_delete_comment(){
        $author = User::factory()->create();
        $post = Post::factory()->create();
        
        $comment = Comment::factory()->create([
            'user_id' => $author->id,
            'post_id' => $post->id
        ]);

        $this->actingAs($author)->delete('comment/' . $comment->id);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id
        ]);
    }
}