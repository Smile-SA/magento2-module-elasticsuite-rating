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
namespace Smile\ElasticsuiteRating\Model\Product\Indexer\Fulltext\Datasource;

use Smile\ElasticsuiteCore\Api\Index\DatasourceInterface;
use Smile\ElasticsuiteRating\Model\ResourceModel\Product\Indexer\Fulltext\Datasource\RatingData as ResourceModel;

/**
 * Ratings Datasource
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
     * Add rating data to the index data.
     *
     * {@inheritdoc}
     */
    public function addData($storeId, array $indexData)
    {
        $ratingData = $this->resourceModel->loadRatingData($storeId, array_keys($indexData));

        array_walk($indexData, [$this, 'fillRatingsData']);

        foreach ($ratingData as $ratingDataRow) {
            $productId = (int) $ratingDataRow['product_id'];
            $indexData[$productId]['ratings_summary'] = (float) $ratingDataRow['ratings_summary'];

            if (!isset($indexData[$productId]['indexed_attributes'])) {
                $indexData[$productId]['indexed_attributes'] = ['ratings_summary'];
            } elseif (!in_array('ratings_summary', $indexData[$productId]['indexed_attributes'])) {
                // Add ratings_summary only one time.
                $indexData[$productId]['indexed_attributes'][] = 'ratings_summary';
            }
        }

        return $indexData;
    }

    /**
     * Fill rating summary field with 0.
     *
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod) Used via a callback.
     *
     * @param array $productData Product index data
     */
    private function fillRatingsData(&$productData)
    {
        $productData['ratings_summary'] = 0;
    }
}
