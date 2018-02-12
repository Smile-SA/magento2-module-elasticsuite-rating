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
namespace Smile\ElasticsuiteRating\Setup;

use Magento\Catalog\Api\Data\ProductAttributeInterface;

/**
 * ElasticsuiteRating Setup
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class RatingSetup
{
    /**
     * @var \Magento\Eav\Model\Config $eavConfig
     */
    private $eavConfig;

    /**
     * VirtualCategorySetup constructor.
     *
     * @param \Magento\Eav\Model\Config $eavConfig EAV Config.
     */
    public function __construct(\Magento\Eav\Model\Config $eavConfig)
    {
        $this->eavConfig = $eavConfig;
    }

    /**
     * Create product rating attribute.
     *
     * @param \Magento\Eav\Setup\EavSetup $eavSetup EAV module Setup
     */
    public function createRatingAttributes($eavSetup)
    {
        $entity = ProductAttributeInterface::ENTITY_TYPE_CODE;
        $eavSetup->addAttribute(
            $entity,
            'ratings_summary',
            [
                'type'                       => 'decimal',
                'label'                      => 'Product Rating',
                'input'                      => 'hidden',
                'global'                     => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'required'                   => false,
                'default'                    => 0,
                'visible'                    => true,
                'sort_order'                 => 200,
                'visible_on_front'           => 0,
                'searchable'                 => 1,
                'visible_in_advanced_search' => 0,
                'filterable'                 => 1,
                'filterable_in_search'       => 1,
                'is_used_in_grid'            => 0,
                'is_visible_in_grid'         => 0,
                'is_filterable_in_grid'      => 0,
                'used_for_sort_by'           => 1,
            ]
        );

        $attributeId         = $eavSetup->getAttributeId($entity, 'ratings_summary');
        $defaultAttributeSet = $eavSetup->getAttributeSetId($entity, 'Default');
        $defaultGroup        = $eavSetup->getAttributeGroupId($entity, $defaultAttributeSet, 'General');

        $eavSetup->addAttributeToSet($entity, $defaultAttributeSet, $defaultGroup, $attributeId);
    }

    /**
     * Rename rating_summary to ratings_summary
     *
     * @param \Magento\Eav\Setup\EavSetup $eavSetup EAV module Setup
     */
    public function renameRatingAttribute($eavSetup)
    {
        $entity = ProductAttributeInterface::ENTITY_TYPE_CODE;
        if ($eavSetup->getAttributeId($entity, 'rating_summary') !== false) {
            $eavSetup->updateAttribute($entity, 'rating_summary', ['attribute_code' => 'ratings_summary']);
        }
    }
}
