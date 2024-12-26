<?php

namespace Hex\ValueObjects;

use Hex\Enums\Category;
use Hex\Enums\Language;

readonly class Joke
{
    public function __construct(
        public string $content,
        public Language $language,
        public Category $category,
    ) {
        // Silence is golden...
    }
}
