<?php
/**
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Tony DEPLANQUE <todep@smile.fr>
 * @copyright 2016 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Smile\ElasticsuiteRating\Plugin;

class ConfigPlugin
{
    /**
     * Add Rating to Available Product Listing Sort By
     * @param \Magento\Catalog\Model\Config $config Observable Class.
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - $config not used here
     */
    public function afterGetAttributeUsedForSortByArray(\Magento\Catalog\Model\Config $config, $options)
    {
        $options['rating_summary'] = __('Rating');
        return $options;
    }
}
