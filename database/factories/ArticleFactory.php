<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Article::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence,
            'penulis' => $this->faker->name,
            'isi' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
        ];
    }
}
