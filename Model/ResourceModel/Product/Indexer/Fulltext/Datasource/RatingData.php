<?php

namespace Smile\ElasticsuiteRating\Model\ResourceModel\Product\Indexer\Fulltext\Datasource;

use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\StoreManagerInterface;
use Smile\ElasticsuiteCatalog\Model\ResourceModel\Eav\Indexer\Indexer;

/**
 * Catalog Inventory Data source resource model
 *
 * @category Smile
 * @package  Smile\ElasticsuiteCatalog
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class RatingData extends Indexer
{
    /**
     * @var \Magento\CatalogInventory\Api\StockRegistryInterface
     */
    private $stockRegistry;

    /**
     * InventoryData constructor.
     *
     * @param ResourceConnection     $resource      Database adapter.
     * @param StoreManagerInterface  $storeManager  Store manager.
     * @param StockRegistryInterface $stockRegistry Stock registry.
     */
    public function __construct(
        ResourceConnection $resource,
        StoreManagerInterface $storeManager,
        StockRegistryInterface $stockRegistry
    ) {
        $this->stockRegistry = $stockRegistry;
        parent::__construct($resource, $storeManager);
    }

    /**
     * Load inventory data for a list of product ids and a given store.
     *
     * @param integer $storeId    Store id.
     * @param array   $productIds Product ids list.
     *
     * @return array
     */
    public function loadRatingData($storeId, $productIds)
    {

        $select = $this->getConnection()->select()
            ->from(
                $this->getTable('review_entity_summary'),
                [
                    'entity_pk_value as product_id',
                    'avg(rating_summary) as rating_summary'
                ]
            )
            ->where('ciss.store_id = ?', $storeId)
            ->where('cpe.entity_pk_value IN(?)', $productIds);

        return $this->getConnection()->fetchAll($select);
    }


}
