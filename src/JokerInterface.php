<?php

namespace Hex;

use Hex\Enums\Category;
use Hex\Enums\Language;
use Hex\ValueObjects\Joke;

interface JokerInterface
{
    /** @return Joke[] */
    public function tell(Category $category, Language $language, int $amount = 1): array;
}
