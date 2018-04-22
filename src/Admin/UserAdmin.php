<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 20.04.18
 * Time: 15:24
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('username')
            ->add('plainPassword', PasswordType::class)
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('roles')
            ->add('acceptRules', CheckboxType::class)
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('username')
            ->addIdentifier('email')
            ->addIdentifier('roles')

        ;

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('roles')
        ;

    }


}