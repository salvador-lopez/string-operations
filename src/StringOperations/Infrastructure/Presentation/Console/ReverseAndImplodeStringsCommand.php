<?php

namespace StringOperations\Infrastructure\Presentation\Console;

use StringOperations\UseCase\ReverseArrayAndItsValuesRequest;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReverseAndImplodeStringsCommand extends ContainerAwareCommand
{
    const STRING_ARGUMENT_1 = 'string1';
    const STRING_ARGUMENT_2 = 'string2';
    const STRING_ARGUMENT_3 = 'string3';
    const STRING_ARGUMENT_4 = 'string4';
    const STRING_ARGUMENT_5 = 'string5';

    protected function configure()
    {
        $this
            ->setName('reverse-and-implode-strings')
            ->setDescription(
                'Given five strings , it revert and return them imploded'
            )
            ->setHelp("Example of command execution: ".
                "bin/console.php reverse-and-implode-strings 'Lorem' 'isum' 'dolor' 'sit' 'amet'"
            )->addArgument(
                self::STRING_ARGUMENT_1,
                InputArgument::REQUIRED,
                'String 1'
            )->addArgument(
                self::STRING_ARGUMENT_2,
                InputArgument::REQUIRED,
                'String 2'
            )->addArgument(
                self::STRING_ARGUMENT_3,
                InputArgument::REQUIRED,
                'String 3'
            )->addArgument(
                self::STRING_ARGUMENT_4,
                InputArgument::REQUIRED,
                'String 4'
            )->addArgument(
                self::STRING_ARGUMENT_5,
                InputArgument::REQUIRED,
                'String 5'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $useCase = $this->getContainer()->get('string_operations.reverse_array_and_its_values_use_case');

        try {
            $request = $this->buildUseCaseRequest($this->getStringArgumentsFromInput($input));
            $output->writeln($useCase->execute($request));
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }

    }

    private function getStringArgumentsFromInput(InputInterface $input): array
    {
        $arguments = $input->getArguments();

        unset($arguments['command']);

        return $arguments;
    }

    private function buildUseCaseRequest(array $strings): ReverseArrayAndItsValuesRequest
    {
        return new ReverseArrayAndItsValuesRequest($strings);
    }
}
