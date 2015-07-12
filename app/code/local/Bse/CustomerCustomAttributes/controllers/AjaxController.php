<?php

class Bse_CustomerCustomAttributes_AjaxController extends Mage_Core_Controller_Front_Action
{
    // action_url : ajax_product_customisation/ajax/save_selection
    public function save_selectionAction(){
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            // Load the customer's data
            $customer = Mage::getSingleton('customer/session')->getCustomer();

            $selections = unserialize($customer->getSelectionCustomizer());
            $selections[] = array('productId' => 1, 'selectedOptions' => 'x:2,x2,x1');
            $customer->setSelectionCustomizer(serialize($selections));
            $customer->save();

            $msg = 'Selection ajoutée avec succès !';
            $response = array('status' => 'success', 'msg' => $msg);
            echo json_encode($response);
        }else{
            $msg = 'Vous devez être connécté pour pouvoir enregistrer la séléction !';
            $response = array('status' => 'fail', 'msg' => $msg);
            echo json_encode($response);
        }
    }
}