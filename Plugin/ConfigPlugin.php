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
 * Plugin to add Ratings data to sortable attributes.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Tony DEPLANQUE <todep@smile.fr>
 */
class ConfigPlugin
{
    /**
     * Add Rating to Available Product Listing Sort By
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - $config not used here
     *
     * @param \Magento\Catalog\Model\Config $config Observable Class.
     *
     * @return array
     */
    public function afterGetAttributeUsedForSortByArray(\Magento\Catalog\Model\Config $config, $options)
    {
        $options['rating_summary'] = __('Rating');
        return $options;
    }
}
