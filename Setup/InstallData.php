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

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

/**
 * ElasticsuiteRating Install Data Script.
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Smile\ElasticsuiteRating\Setup\RatingSetup
     */
    private $ratingSetup;

    /**
     * InstallData constructor.
     *
     * @param \Magento\Eav\Setup\EavSetupFactory          $eavSetupFactory EAV Setup Factory
     * @param \Smile\ElasticsuiteRating\Setup\RatingSetup $ratingSetup     Rating Setup
     */
    public function __construct(EavSetupFactory $eavSetupFactory, RatingSetup $ratingSetup)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->ratingSetup     = $ratingSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $this->ratingSetup->createRatingAttributes($eavSetup);

        $setup->endSetup();
    }
}
