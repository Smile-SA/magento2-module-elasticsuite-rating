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
namespace Smile\ElasticsuiteRating\Block\Navigation\Renderer;

/**
 * Rating Filter renderer block
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class Rating extends \Smile\ElasticsuiteCatalog\Block\Navigation\Renderer\Attribute
{
    /**
     * {@inheritDoc}
     */
    public function getJsLayout()
    {
        $filterItems = $this->getFilter()->getItems();

        $jsLayoutConfig = [
            'component'    => self::JS_COMPONENT,
            'hasMoreItems' => false,
            'template'     => 'Smile_ElasticsuiteRating/rating-filter',
            'maxSize'      => count($filterItems),
        ];

        foreach ($filterItems as $item) {
            $jsLayoutConfig['items'][] = $item->toArray(['label', 'count', 'url', 'is_selected']);
        }

        return json_encode($jsLayoutConfig);
    }

    /**
     * {@inheritDoc}
     */
    protected function canRenderFilter()
    {
        return $this->getFilter() instanceof \Smile\ElasticsuiteRating\Model\Layer\Filter\Rating;
    }
}
