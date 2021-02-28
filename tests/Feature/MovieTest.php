<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase{
    
    /** @test */
    public function show_movie_on_page(){
        $movie = Movie::factory()->create([
            'title' => 'Adwokat diabła'
        ]);
        $response = $this->get('/');
        $response->assertStatus(200)->assertSeeText('Adwokat diabła');
    }

    /** @test */
    public function show_three_last_add_movie_on_page(){
        $movie1 = Movie::factory()->create([
            'created_at' => Carbon::tomorrow()
        ]);
        $movie2 = Movie::factory()->create([
            'created_at' => Carbon::tomorrow()
        ]);
        $movie3 = Movie::factory()->create([
            'created_at' => Carbon::tomorrow()
        ]);
        $movie4 = Movie::factory()->create([
            'created_at' => Carbon::now()
        ]);
        
        $latest = Movie::orderBy('created_at', 'desc')->limit(3)->get();

        $this->assertTrue($latest->contains($movie1));
        $this->assertTrue($latest->contains($movie2));
        $this->assertTrue($latest->contains($movie3));
        $this->assertFalse($latest->contains($movie4));
    }

    /** @test */
    public function show_movie_in_route(){
        $movie = Movie::factory()->create([
            'title' => 'Siedem'
        ]);
        
        $response = $this->get('movie/' . $movie->id);

        $response->assertStatus(200)->assertSeeText('Siedem');
    }

    /** @test */
    public function show_post_bottom_movie(){
        $movie = Movie::factory()->create();

        $post = Post::factory()->create([
            'movie_id' => $movie->id,
            'content' => 'First post' 
        ]);

        $response = $this->get('movie/' . $post->movie_id);

        $response->assertStatus(200)->assertSeeText('First post');
    }
}