<?php declare(strict_types=1);

namespace ItdelightArraySorts\Command;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetProducts extends Command
{
    protected static $defaultName = 'itdelight:getProducts';

    private EntityRepositoryInterface $productRepository;

    public function __construct(
        EntityRepositoryInterface $entityRepository
    ) {
        $this->productRepository = $entityRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Get list of all products');
    }

    // Actual code executed in the command
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $searchResult = $this->productRepository->search(new Criteria(), Context::createDefaultContext());
        $table = new Table($output);
        $table->setHeaders(['UUID', 'name', 'stock', 'index']);

        foreach ($searchResult->getEntities() as $product) {
            $row = [
                $product->getId(),
                $product->getName(),
                $product->getStock()
            ];

            if (isset($product->getCustomFields()['itdelight_array_sort_index'])) {
                $row[] = $product->getCustomFields()['itdelight_array_sort_index'];
            }
            $table->addRow($row);
        }
        $table->render();

        return 0;
    }
}
