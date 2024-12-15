<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_article()
    {
        // Data untuk artikel
        $data = [
            'judul' => 'Test Article',
            'penulis' => 'Author Name',
            'image' => 'storage/articles/2iMozn1OliqWfiBSjWMeOkXeUeGbUK1MNjDvxc2p.jpg', // Pastikan gambar ada di storage
            'isi' => 'This is the content of the test article.',
        ];

        // Menyimpan artikel
        $article = Article::create($data);

        // Memastikan artikel telah disimpan di database
        $this->assertDatabaseHas('artikel', [
            'judul' => 'Test Article',
            'penulis' => 'Author Name',
        ]);
    }

    /** @test */
    public function it_retrieves_an_article_by_id()
    {
        // Membuat artikel
        $article = Article::factory()->create();

        // Mengambil artikel dari database
        $retrievedArticle = Article::find($article->id_artikel);

        // Memastikan data yang diambil sesuai dengan yang disimpan
        $this->assertEquals($article->id_artikel, $retrievedArticle->id_artikel);
        $this->assertEquals($article->judul, $retrievedArticle->judul);
    }

    /** @test */
    public function it_validates_article_data()
    {
        // Mengirimkan data artikel yang tidak valid
        $response = $this->post('/articles', []);

        // Memastikan validasi error
        $response->assertSessionHasErrors(['judul', 'penulis', 'isi']);
    }

}
