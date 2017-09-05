<?php

class Indust_CustomShippingRate_Model_Quote_Address_Total_Shipping extends Mage_Sales_Model_Quote_Address_Total_Shipping
{
    /**
     * Collect totals information about shipping
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     * @return  Mage_Sales_Model_Quote_Address_Total_Shipping
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        if ($address->getShippingMethod() == 'customshippingrate_customshippingrate') {
            $address->setCollectShippingRates(true);    // force magento to recollect shipping rates because our form input from backend should be saved

            if ($address->getBaseShippingAmount() > 0) {    // when data is entered in backend order create
                Mage::register(Indust_CustomShippingRate_Model_Carrier_Customshippingrate::BASE_SHIPPING_AMOUNT, $address->getBaseShippingAmount(), true);
            } else {    // when order is submitted in backend
                Mage::register(Indust_CustomShippingRate_Model_Carrier_Customshippingrate::BASE_SHIPPING_AMOUNT, $address->getOrigData('base_shipping_amount'), true);
            }
            if ($address->getShippingAmount() > 0) {// when data is entered in backend order create
                Mage::register(Indust_CustomShippingRate_Model_Carrier_Customshippingrate::SHIPPING_AMOUNT, $address->getShippingAmount(), true);
            } else {// when order is submitted in backend
                Mage::register(Indust_CustomShippingRate_Model_Carrier_Customshippingrate::SHIPPING_AMOUNT, $address->getOrigData('shipping_amount'), true);
            }
            if ($address->getShippingDescription()) {// when data is entered in backend order create
                Mage::register(Indust_CustomShippingRate_Model_Carrier_Customshippingrate::SHIPPING_DESCRIPTION, $address->getShippingDescription(), true);
            } else {// when order is submitted in backend
                Mage::register(Indust_CustomShippingRate_Model_Carrier_Customshippingrate::SHIPPING_DESCRIPTION, $address->getOrigData('shipping_description'), true);
            }

        }
        return parent::collect($address);
    }
}
