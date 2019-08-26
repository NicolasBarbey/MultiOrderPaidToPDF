<?php

namespace MultiOrderPaidToPdf\Controller;


use Exception;
use MultiOrderPaidToPdf\Form\InvoicingForm;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Model\ConfigQuery;

/**
 * Class MultiOrderPaidToPdfController
 * @package MultiOrderPaidToPdf\Controller
 * @author Baixas Alban <abaixas@openstudio.fr>
 */
class MultiOrderPaidToPdfController extends BaseAdminController
{
    public function generatePdf()
    {
	ini_set('max_execution_time', 3000);
        ini_set('memory_limit', '2048M');

        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), array('MultiOrderPaidToPdf'), AccessManager::CREATE)) {
            return $response;
        }

        $errorMessage = null;

        $form = new InvoicingForm($this->getRequest());

        try {

            $orderListId = $this->validateForm($form)->getData();

            if(empty($orderListId['order_id'])) {

                throw new \Exception('il faut sélectionner au moins une commande');

            }

            $orderIds = implode(',',array_keys($orderListId['order_id']));

            $response = $this->generateOrderPdf($orderIds, ConfigQuery::read('pdf_invoice_file', 'invoice'));

            return $response;

        } catch (Exception $e) {

            return $this->render("orders", array(
                "display_order" => 20,
                "orders_order"   => $this->getListOrderFromSession("orders", "orders_order", "create-date-reverse"),
                "error_message_multi_order" => $e->getMessage()
            ));

        }

    }
}

