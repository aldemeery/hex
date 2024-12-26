<?php

namespace App;

use RuntimeException;
use Hex\Enums\Category;
use Hex\Enums\Language;
use Hex\JokeRepositoryInterface;

class JokeApi implements JokeRepositoryInterface
{
    public function getJokes(Category $category, Language $language, int $amount = 1): array
    {
        $response = file_get_contents("https://v2.jokeapi.dev/joke/{$category->value}?type=single&lang={$language->value}&amount={$amount}");
        $jokes = json_decode($response, true);

        if ($jokes['error']) {
            throw new RuntimeException($jokes['message']);
        }

        $jokes = $amount === 1 ? [$jokes] : $jokes['jokes'];

        return $jokes;
    }
}
