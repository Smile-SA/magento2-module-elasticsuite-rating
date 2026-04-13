<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Vadym Honcharuk <vahonc@smile.fr>
 * @copyright 2026 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Smile\ElasticsuiteRating\Model\Layer\Filter\TypeProvider;

use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Smile\ElasticsuiteCatalog\Api\Layer\Filter\TypeProviderInterface;
use Smile\ElasticsuiteRating\Model\Layer\Filter\Rating as RatingFilter;

/**
 * Filter type provider for Rating layer filter
 *
 * This class allows overriding the default filter class for the "ratings_summary" attribute.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Vadym Honcharuk <vahonc@smile.fr>
 */
class Rating implements TypeProviderInterface
{
    /**
     * Rating Summary attribute code.
     */
    const RATING_SUMMARY_ATTRIBUTE = 'ratings_summary';

    /**
     * {@inheritdoc}
     */
    public function getFilterClassName(Attribute $attribute, string $originalFilterClassName): string
    {
        if ($attribute->getAttributeCode() === self::RATING_SUMMARY_ATTRIBUTE) {
            return RatingFilter::class;
        }

        return $originalFilterClassName;
    }
}
