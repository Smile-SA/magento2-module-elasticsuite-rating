<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Tony DEPLANQUE <todep@smile.fr>
 * @copyright 2016 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticsuiteRating\Model\ResourceModel\Product\Indexer\Fulltext\Datasource;

use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\StoreManagerInterface;
use Smile\ElasticsuiteCatalog\Model\ResourceModel\Eav\Indexer\Indexer;

/**
 * Catalog Rating Data source resource model
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Tony DEPLANQUE <todep@smile.fr>
 */
class RatingData extends Indexer
{
    /**
     * RatingData constructor.
     *
     * @param ResourceConnection    $resource     Database adapter.
     * @param StoreManagerInterface $storeManager Store manager.
     */
    public function __construct(
        ResourceConnection $resource,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($resource, $storeManager);
    }

    /**
     * Load rating data for a list of product ids and a given store.
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
            ->where('review_entity_summary.store_id = ?', $storeId)
            ->where('review_entity_summary.entity_pk_value IN(?)', $productIds)
            ->group('entity_pk_value');

        return $this->getConnection()->fetchAll($select);
    }
}
