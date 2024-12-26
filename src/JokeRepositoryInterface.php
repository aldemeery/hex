<?php

namespace Hex;

use Hex\Enums\Category;
use Hex\Enums\Language;

interface JokeRepositoryInterface
{
    public function getJokes(Category $category, Language $language, int $amount = 1): array;
}
