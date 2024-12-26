<?php

namespace Hex;

use Hex\Enums\Category;
use Hex\Enums\Language;
use Hex\ValueObjects\Joke;

class Joker implements JokerInterface
{
    public function __construct(
        private JokeRepositoryInterface $jokeRepository
    ) {
        // Silence is golden...
    }

    public function tell(Category $category, Language $language, int $amount = 1): array
    {
        $jokes = $this->jokeRepository->getJokes($category, $language, $amount);

        return array_map(function ($joke) {
            return new Joke(
                $joke['joke'],
                Language::tryFrom(strtolower($joke['lang'])),
                Category::tryFrom(strtolower($joke['category'])),
            );
        }, $jokes);
    }
}
