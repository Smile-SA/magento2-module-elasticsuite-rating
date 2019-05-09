<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Smile ElasticSuite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2019 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticsuiteRating\Plugin\Search\Request\Product\Attribute;

/**
 * Plugin to set aggregation builder for ratings.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class AggregationResolver
{
    /**
     * Rating Summary attribute code.
     */
    const RATING_SUMMARY_ATTRIBUTE = 'ratings_summary';

    /**
     * @var \Smile\ElasticsuiteRating\Search\Request\Product\Attribute\Aggregation\Rating
     */
    private $ratingAggregation;

    /**
     * AggregationResolver constructor.
     *
     * @param \Smile\ElasticsuiteRating\Search\Request\Product\Attribute\Aggregation\Rating $ratingAggregation Rating Aggregation
     */
    public function __construct(\Smile\ElasticsuiteRating\Search\Request\Product\Attribute\Aggregation\Rating $ratingAggregation)
    {
        $this->ratingAggregation = $ratingAggregation;
    }

    /**
     * Set default facet size to 0 for swatches attributes before adding it as aggregation.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param \Smile\ElasticsuiteCatalog\Search\Request\Product\Attribute\AggregationResolver $subject   Aggregation Resolver
     * @param array                                                                           $result    Aggregation Config
     * @param \Magento\Catalog\Model\ResourceModel\Eav\Attribute                              $attribute Attribute
     *
     * @return array
     */
    public function afterGetAggregationData(
        \Smile\ElasticsuiteCatalog\Search\Request\Product\Attribute\AggregationResolver $subject,
        $result,
        $attribute
    ) {
        if ($attribute->getAttributeCode() === self::RATING_SUMMARY_ATTRIBUTE) {
            $result = $this->ratingAggregation->getAggregationData($attribute);
        }

        return $result;
    }
}
