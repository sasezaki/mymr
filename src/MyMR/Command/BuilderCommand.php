<?php
/**
 * Command for builder script based MapReduce definition.
 *
 * @author Yuya Takeyama
 */
namespace MyMR\Command;

use \MyMR\Database,
    \MyMR\Table;

use \Symfony\Component\Console\Command\Command,
    \Symfony\Component\Console\Input\InputInterface,
    \Symfony\Component\Console\Input\InputArgument,
    \Symfony\Component\Console\Input\InputOption,
    \Symfony\Component\Console\Output\OutputInterface;

class BuilderCommand extends Command
{
    public function configure()
    {
        $this
            ->setName('builder')
            ->setDescription('Executes builder script based MapReduce definition')
            ->setDefinition(array(
                new InputArgument('file', InputArgument::REQUIRED, 'definition file')
            ))
            ->addOption('input', 'i', InputOption::VALUE_OPTIONAL, 'URI of input table')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'URI of output table');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $builder = require $input->getArgument('file');
        $inputTable = $input->getOption('input');
        if ($inputTable) {
            $builder->setInputTable($inputTable);
        }
        $outputTable = $input->getOption('output');
        if ($outputTable) {
            $builder->setOutputTable($outputTable);
        }
        $builder->getMapReduce()->execute($output);
    }
}
