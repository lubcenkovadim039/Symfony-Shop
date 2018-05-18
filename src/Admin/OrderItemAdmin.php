<?php
/**
 * Created by PhpStorm.
 * User: skillup-student
 * Date: 18.05.18
 * Time: 19:16
 */

namespace App\Admin;


use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class OrderItemAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('product', SuggestType::class, [
                'suggester' => 'product'
            ])
            ->add('quantityOfOrder', null, [
                'attr' =>
                    [
                    'class' => 'js-order-item-quantity',
                    ]
            ])
            ->add('price',null,
                [
                    'attr' =>
                        [

                            'class' => 'js-order-item-price',
                        ]
                ])
            ->add('total', null,
                [
                'attr' =>
                    [
                    'readonly' => '1',
                    'class' => 'js-order-item-total',
                    ]
                ]);
    }


}