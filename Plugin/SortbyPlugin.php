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
namespace Smile\ElasticsuiteRating\Plugin;

/**
 * Plugin to add Ratings data to sortable attributes for a category.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Tony DEPLANQUE <todep@smile.fr>
 */
class SortbyPlugin
{
    /**
     * Add rating summary to sort product
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - $sortby not used here
     *
     * @param \Magento\Catalog\Model\Category\Attribute\Source\Sortby $sortby  Observable Class.
     * @param array                                                   $options The options
     *
     * @return array
     */
    public function afterGetAllOptions(\Magento\Catalog\Model\Category\Attribute\Source\Sortby $sortby, $options)
    {
        $options[] = ['label' => __('Rating'), 'value' => 'rating_summary'];

        return $options;
    }
}
