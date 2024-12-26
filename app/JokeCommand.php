<?php

namespace App;

use Hex\Enums\Category;
use Hex\Enums\Language;
use Hex\JokerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

#[AsCommand(
    name: 'joke:tell',
    description: 'Tell a joke',
)]
class JokeCommand extends Command
{
    public function __construct(
        private JokerInterface $joker
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $language = $this->askForLanguage($input, $output);
        $category = $this->askForCategory($input, $output);
        $amount = $input->getArgument('amount') ?? 1;

        foreach ($this->joker->tell($category, $language, $amount) as $joke) {
            $output->writeln("- " . $joke->content . PHP_EOL);
        }

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('amount', InputArgument::OPTIONAL, 'Amount of jokes to tell', 1);
    }

    private function askForLanguage(InputInterface $input, OutputInterface $output): Language
    {
        $helper = $this->getHelper('question');

        return Language::from($helper->ask($input, $output, new ChoiceQuestion(
            'Select Language',
            array_map(fn ($language) => $language->value, Language::cases()),
            0
        )));
    }

    private function askForCategory(InputInterface $input, OutputInterface $output): Category
    {
        $helper = $this->getHelper('question');

        return Category::from($helper->ask($input, $output, new ChoiceQuestion(
            'Select Category',
            array_map(fn ($language) => $language->value, Category::cases()),
            0
        )));
    }
}
