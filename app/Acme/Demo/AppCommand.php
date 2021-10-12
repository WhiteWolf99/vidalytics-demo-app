<?php

namespace Acme\Demo;

use Acme\Basket\Basket;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AppCommand extends Command
{
    /**
     * In this method setup command, description, and its parameters.
     */
    protected function configure()
    {
        $this->setName('demo');
        $this->setDescription('Demo application for vidalytics');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Demo app</info>');

        $examples = [
            ['B01', 'G01'],
            ['R01', 'R01'],
            ['R01', 'G01'],
            ['B01', 'B01', 'R01', 'R01', 'R01'],
        ];

        foreach ($examples as $id => $example) {
            $output->writeln(sprintf('<fg=white;bg=green>Example #%d</>', $id + 1));
            try {
                $basket = new Basket();

                foreach ($example as $productCode) {
                    $basket->add($productCode);
                }

                $table = new Table($output);

                $table->setHeaderTitle('Basket')
                      ->setHeaders(['Code', 'Name', 'Price']);

                foreach ($basket->getLineItems() as $product) {
                    $table->addRow([$product->getCode(), $product->getName(), $product->getPrice()]);
                }

                $table
                    ->addRow(new TableSeparator())
                    ->addRow([new TableCell('Total', ['colspan' => 2]), $this->formatNumber($basket->getTotal(), 2)]);

                $table->render();
            } catch (\Exception $e) {
                $output->writeln(sprintf('<error> Error for example %d: %s</error>', $id + 1, $e->getMessage()));
            }
        }

        return self::SUCCESS;
    }

    //instead of using number_format because it always rounding up decimals..
    public function formatNumber($number, $precision)
    {
        return floor($number).substr(str_replace(floor($number), '', $number), 0, $precision + 1);
    }
}
