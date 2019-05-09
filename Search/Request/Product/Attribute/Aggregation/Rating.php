<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2019 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Smile\ElasticsuiteRating\Search\Request\Product\Attribute\Aggregation;

use Smile\ElasticsuiteCatalog\Search\Request\Product\Attribute\AggregationInterface;
use Smile\ElasticsuiteCore\Search\Request\BucketInterface;

/**
 * Aggregation builder for product ratings.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class Rating implements AggregationInterface
{
    /**
     * Default interval, based on 0-100 divided in five stars.
     */
    const RATING_AGG_INTERVAL = 20;

    /**
     * {@inheritdoc}
     */
    public function getAggregationData(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute)
    {
        $bucketConfig = [
            'name'        => $this->getFilterField($attribute),
            'type'        => BucketInterface::TYPE_HISTOGRAM,
            'minDocCount' => 1,
            'interval'    => (int) self::RATING_AGG_INTERVAL,
        ];

        return $bucketConfig;
    }

    /**
     * Retrieve ES filter field.
     *
     * @param \Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute Attribute
     *
     * @return string
     */
    private function getFilterField(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute)
    {
        $field = $attribute->getAttributeCode();

        return $field;
    }

}
