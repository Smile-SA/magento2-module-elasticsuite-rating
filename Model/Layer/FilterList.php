<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2017 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticsuiteRating\Model\Layer;

/**
 * Override of FilterList to add custom renderer for Rating Filter.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class FilterList extends \Smile\ElasticsuiteCatalog\Model\Layer\FilterList
{
    /**
     * Rating filter name
     */
    const RATING_FILTER = 'rating';

    /**
     * {@inheritDoc}
     */
    protected function getAttributeFilterClass(\Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute)
    {
        $filterClassName = parent::getAttributeFilterClass($attribute);

        if ($attribute->getAttributeCode() === 'ratings_summary') {
            $filterClassName = $this->filterTypes[self::RATING_FILTER];
        }

        return $filterClassName;
    }
}
