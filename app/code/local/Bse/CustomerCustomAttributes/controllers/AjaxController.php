<?php

class Bse_CustomerCustomAttributes_AjaxController extends Mage_Core_Controller_Front_Action
{
    // action_url : ajax_product_customisation/ajax/save_selection
    public function save_selectionAction(){
        $selectionData =Mage::app()->getFrontController()->getRequest()->getParam('selectionData');

        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            // Load the customer's data
            $customer = Mage::getSingleton('customer/session')->getCustomer();

            $selections = json_decode($customer->getSelectionCustomizer());
            $selectionData = json_decode(stripslashes($selectionData)); // decode stringified json structure to PHP array
            $selections[] = array('selectionData' => $selectionData, 'date'=>date("Y-m-d H:i:s"));
            $customer->setSelectionCustomizer(json_encode($selections));
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