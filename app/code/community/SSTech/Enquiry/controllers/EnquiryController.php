<?php
class SSTech_Enquiry_EnquiryController extends Mage_Core_Controller_Front_Action{
		public function IndexAction() {
				  
				  $this->loadLayout();   
				  $this->getLayout()->getBlock("head")->setTitle($this->__("Enquiry"));
						$breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
				  $breadcrumbs->addCrumb("home", array(
							"label" => $this->__("Home Page"),
							"title" => $this->__("Home Page"),
							"link"  => Mage::getBaseUrl()
					   ));

				  $breadcrumbs->addCrumb("enquiries", array(
							"label" => $this->__("Enquiry"),
							"title" => $this->__("Enquiry")
					   ));

				  $this->renderLayout(); 
				  }

		 public function enquiryAction() {
		          $postData = Mage::app()->getRequest()->getPost();	
				
				try{
				   $model = Mage::getModel('enquiry/enquiry');
				   $postData['telephone'] = preg_replace("/[^0-9]/","",$postData['telephone']);
				   $model->setData($postData);
				   $model->setCreatedDate(now());
				   $model->setUpdatedDate(now());
				   $model->setCreatedBy($postData['name']);
				   $model->save();
				   $message = $this->__('You Have Submitted Your Enquiry Successfully.');
                   Mage::getSingleton('core/session')->addSuccess($message);
				   $this->_redirect("*/*/");
				   }
				catch(Exception $ex)
				{
				
				}
		}
}