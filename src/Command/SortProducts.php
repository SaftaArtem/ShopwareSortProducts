<?php

namespace ItdelightArraySorts\Command;

use ItdelightArraySorts\Service\SortManagerInterface;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SortProducts extends Command
{
    protected static $defaultName = 'itdelight:sort:products';

    private EntityRepositoryInterface $entityRepository;
    private SortManagerInterface $sortManager;

    public function __construct(
        EntityRepositoryInterface $entityRepository,
        SortManagerInterface $sortManager
    ) {
        $this->entityRepository = $entityRepository;
        parent::__construct();
        $this->sortManager = $sortManager;
    }

    protected function configure(): void
    {
        $this->setDescription('Sort products via stock');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $searchResult = $this->entityRepository->search(new Criteria(), Context::createDefaultContext());

        $data = $this->getData($searchResult->getEntities());
        $sorted = $this->sortManager->sort($data);


        $this->saveProducts($sorted);

        $output->writeln('ok');

        return 0;
    }

    public function getData(EntityCollection $products): array
    {
        $data = [];
        foreach ($products as $product) {
            $data[] = ['id' => $product->getId(), 'stock' => $product->getStock()];
        }

        return $data;
    }

    public function saveProducts(array $sorted)
    {
        foreach ($sorted as $index => $product) {
            $this->entityRepository->upsert([
                [
                    'id' => $product['id'],
                    'customFields' => ['itdelight_array_sort_index' => strval($index)]
                ]
            ], Context::createDefaultContext());
        }
    }

}
