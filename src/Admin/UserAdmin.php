<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
       $form
            ->add('username')
           ->add('email')
           ->add('password')
           ->add('firstName')
           ->add('lastName')
           ->add('roles')
           ->add('acceptRules', CheckboxType::class)
       ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id ')
            ->addIdentifier('username  ')
            ->addIdentifier('email  ')




        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
       $filter
           ->add('id')
           ->add('username')
           ->add('email')
           ->add('firstName')
           ->add('lastName')
           ->add('roles')
       ;
    }


}