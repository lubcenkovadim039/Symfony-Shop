<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 17.05.18
 * Time: 16:12
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrderAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('create_at', 'date', array('format' => 'd/M/y'))
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
