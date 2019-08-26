<?php
/**
 * Created by PhpStorm.
 * User: alban
 * Date: 17/07/14
 * Time: 11:11
 */

namespace MultiOrderPaidToPdf\Form;


use Thelia\Form\BaseForm;

/**
 * Class InvoicingForm
 * @package MultiOrderPaidToPdf\Form
 * @author Baixas Alban <abaixas@openstudio.fr>
 */
class InvoicingForm extends BaseForm
{


    protected function buildForm()
    {
        $this->formBuilder
                ->add('order_id', 'collection', array(
                    'type'         => "text",
                    'allow_add'    => true,
                    'allow_delete' => true,
                ));
    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return 'multi_order_pdf_invoicing_form';
    }
}