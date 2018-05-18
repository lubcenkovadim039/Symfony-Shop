<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 17.05.18
 * Time: 16:12
 */

namespace App\Admin;


use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;

class OrderAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('createAt')
            ->add('status')
            ->add('isPaid')
            ->add('amout', null, [
                'attr' => [
                    'readonly' => '1',
                    'class' => 'js-order-amount'
                ]
            ])
            ->add('user', SuggestType::class, [
                'suggester' => 'user',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('phone')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('comment')
            ->add('items',CollectionType::class, [
                'by_reference' => false
            ], [
                'edit' => 'inline',
                'inline' => 'table'
            ])
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('createAt', 'date', array('format' => 'd/M/y'))
            ->addIdentifier('status')
            ->addIdentifier('amout')
            ->addIdentifier('email')
            ->addIdentifier('phone')
            ->addIdentifier('firstName')
            ->addIdentifier('lastName')
            ->addIdentifier('comment');

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('status')
            ->add('phone')
            ->add('firstName')
            ->add('lastName')
            ->add('email');

    }


}
