<?php
 
class Bse_BodyMeasurementsPage_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        //Get current layout state
        $this->loadLayout();   
 
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'inchoo-simplecontact.simple_contact',
            array(
                'template' => 'Bse/body_measurements.phtml'
            )
        );
 
        $this->getLayout()->getBlock('content')->append($block);
        //$this->getLayout()->getBlock('right')->insert($block, 'catalog.compare.sidebar', true);
 
        $this->_initLayoutMessages('core/session');
 
        $this->renderLayout();
    }
 
    public function sendemailAction()
    {
        //Fetch submited params
        $params = $this->getRequest()->getParams();
 
        $mail = new Zend_Mail();
        $mail->setBodyText($params['comment']);
        $mail->setFrom($params['email'], $params['name']);
        $mail->addTo('somebody_else@example.com', 'Some Recipient');
        $mail->setSubject('Test Inchoo_SimpleContact Module for Magento');
        try {
            $mail->send();
        }        
        catch(Exception $ex) {
            Mage::getSingleton('core/session')->addError('Unable to send email. Sample of a custom notification error from Inchoo_SimpleContact.');
 
        }
 
        //Redirect back to index action of (this) inchoo-simplecontact controller
        $this->_redirect('inchoo-simplecontact/');
    }
}
 
?>