<?php

class Bse_ProductCustomizer_Model_Observer
{
    /**
     * Magento passes a Varien_Event_Observer object as
     * the first parameter of dispatched events.
     */
    public function updateProductPrice(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();
        $quote_item = $event->getQuoteItem();
        /***************************************************************************************************************************/
        /********************************************** By BSE *********************************************************************/
        /***************************************************************************************************************************/

        // save the generatd image
        $data = $_POST['rendered-image'];
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
        $chosenOptions = $_POST['choosed-options'];
        $filename   = md5($chosenOptions).'.png';
        $imageFile   = Mage::getBaseDir('media') . DS . 'product-customizer/generated'. DS . $filename; //path for temp storage folder: ./media/import/
        file_put_contents($imageFile, $data); //store the image from external url to the temp storage folder
        $imageUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA). DS . 'product-customizer/generated'. DS . $filename;

        /*Mage::getSingleton('catalog/product_action')
            ->updateAttributes(array($product->getId()),
                array(
                    'image'=>$imageUrl,
                    'small_image'=>$imageUrl,
                    'thumbnail'=>$imageUrl,
                ),
                0);*/  // 0 specifies the Default*/
        /***************************************************************************************************************************/
        /********************************************** By BSE *********************************************************************/
        /***************************************************************************************************************************/
        //$quote_item->getParentItem()->setData('custom_attribute_column', $imageUrl);
        if($quote_item->getParentItem()){
            $quote_item->getParentItem()->setData('customizer_generated_image', $imageUrl);
            $quote_item->getParentItem()->setData('customizer_chosen_options', $chosenOptions);
            //$quote_item->save(); // BEWARE : CAUSES PROBLEM : NO NEED TO SAVE ACTUALY, BECAUSE IT'S STORED IN THE SESSION
        }
    }


    public function updateProductBeforeOrderSave(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();
        $order = $event->getOrder();
        $orderedItems = $order->getAllVisibleItems();
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $cartItems = $quote->getAllVisibleItems();

        foreach ($orderedItems as $orderedItemKey =>  $orderedItem){
            foreach ($cartItems as $cartItemKey => $cartItem){
                if($orderedItemKey == $cartItemKey){
                    $orderedItem->setData('customizer_generated_image', $cartItem->getData('customizer_generated_image'));
                    $orderedItem->setData('customizer_chosen_options', $cartItem->getData('customizer_chosen_options'));
                }
            }
        }

    }
}
