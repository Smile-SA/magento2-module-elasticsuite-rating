<?php
/**
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Tony DEPLANQUE <todep@smile.fr>
 * @copyright 2016 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticsuiteRating\Plugin;

class SortbyPlugin
{
    /**
     * Add rating summary to sort product
     * @param \Magento\Catalog\Model\Category\Attribute\Source\Sortby $sortby Observable Class.
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - $sortby not used here
     */
    public function afterGetAllOptions(\Magento\Catalog\Model\Category\Attribute\Source\Sortby $sortby, $options)
    {
        $options[] = ['label' => __('Rating'), 'value' => 'rating_summary'];
        return $options;
    }
}
