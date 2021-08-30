<?php
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade Smile Elastic Suite to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\ElasticsuiteRating
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2017 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Smile\ElasticsuiteRating\Model\Layer\Filter;

/**
 * Products Rating Filter Model
 *
 * @category Smile
 * @package  Smile\ElasticsuiteRating
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class Rating extends \Smile\ElasticsuiteCatalog\Model\Layer\Filter\Attribute
{
    /**
     * Default interval, based on 0-100 divided in five stars.
     */
    const RATING_AGG_INTERVAL = 20;

    /**
     * {@inheritDoc}
     */
    public function apply(\Magento\Framework\App\RequestInterface $request)
    {
        $value = $request->getParam($this->_requestVar);

        if (null !== $value) {
            $this->currentFilterValue = $value;

            /** @var \Smile\ElasticsuiteCatalog\Model\ResourceModel\Product\Fulltext\Collection $productCollection */
            $productCollection = $this->getLayer()->getProductCollection();

            $productCollection->addFieldToFilter($this->getFilterField(), ['gte' => $value]);
            $layerState = $this->getLayer()->getState();

            $filterLabel = __('%1 / 5 and more', $value / self::RATING_AGG_INTERVAL);
            if (($value / self::RATING_AGG_INTERVAL) === 5) {
                $filterLabel = __('%1 / 5', $value / self::RATING_AGG_INTERVAL);
            }
            $filter = $this->_createItem($filterLabel, $this->currentFilterValue);

            $layerState->addFilter($filter);
        }

        return $this;
    }

    /**
     * Retrieve ES filter field.
     *
     * @return string
     */
    protected function getFilterField()
    {
        $field = $this->getAttributeModel()->getAttributeCode();

        return $field;
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * {@inheritDoc}
     */
    protected function _initItems()
    {
        $data  = $this->_getItemsData();
        $items = [];
        foreach ($data as $itemData) {
            $items[] = $this->_createItem($itemData['label'], $itemData['value'], $itemData['count']);
        }
        $this->_items = $items;

        return $this;
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * {@inheritDoc}
     */
    protected function _getItemsData()
    {
        /** @var \Smile\ElasticsuiteCatalog\Model\ResourceModel\Product\Fulltext\Collection $productCollection */
        $productCollection = $this->getLayer()->getProductCollection();

        $optionsFacetedData = $productCollection->getFacetedData($this->getFilterField());

        $items = [];

        $sumCount = 0;
        $maxValue = current(array_keys($optionsFacetedData));

        while (($maxValue = $maxValue - self::RATING_AGG_INTERVAL) && $maxValue > 0) {
            if (!isset($optionsFacetedData[$maxValue])) {
                $optionsFacetedData[$maxValue] = ['count' => 0];
            }
        }
        krsort($optionsFacetedData);

        $minCount = !empty($optionsFacetedData) ? min(array_column($optionsFacetedData, 'count')) : 0;

        if (!empty($this->currentFilterValue) || $minCount < $productCollection->getSize()) {
            foreach ($optionsFacetedData as $value => $data) {
                $sumCount      += (int) $data['count'];
                $items[$value] = [
                    'label' => $value,
                    'value' => $value,
                    'count' => $sumCount,
                ];
            }
        }

        return $items;
    }
}
