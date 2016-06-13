<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Tony DEPLANQUE <todep@smile.fr>
 * @copyright 2016 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticsuiteRating\Model\Product\Indexer\Fulltext\Datasource;

use Smile\ElasticsuiteCore\Api\Index\DatasourceInterface;
use Smile\ElasticsuiteRating\Model\ResourceModel\Product\Indexer\Fulltext\Datasource\RatingData as ResourceModel;

/**
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Tony DEPLANQUE <todep@smile.fr>
 */
class RatingData implements DatasourceInterface
{
    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * Constructor.
     *
     * @param ResourceModel $resourceModel Resource model.
     */
    public function __construct(ResourceModel $resourceModel)
    {
        $this->resourceModel = $resourceModel;
    }

    /**
     * Add inventory data to the index data.
     * {@inheritdoc}
     */
    public function addData($storeId, array $indexData)
    {
        $inventoryData = $this->resourceModel->loadRatingData($storeId, array_keys($indexData));

        foreach ($inventoryData as $inventoryDataRow) {
            $productId = (int) $inventoryDataRow['product_id'];
            $indexData[$productId]['rating_summary'] = (float) $inventoryDataRow['rating_summary'];
        }

        return $indexData;
    }
}
