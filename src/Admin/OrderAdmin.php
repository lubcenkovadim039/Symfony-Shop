<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 17.05.18
 * Time: 16:12
 */

namespace App\Admin;


use App\Entity\Order;
use Doctrine\ORM\QueryBuilder;
use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderAdmin extends AbstractAdmin
{

    private $statusLabels = [
        'В корзине' => Order::STATUS_DRAFT,
        'Заказан' => Order::STATUS_ORDERED,
        'Отправлен' => Order::STATUS_SENT,
        'Закрыт' => Order::STATUS_DONE,
    ];

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('createAt')
            ->add('status', ChoiceType::class, [
        'choices' => $this->statusLabels,
                ])
            ->add('isPaid')
            ->add('amout', null, [
                'attr' => [
                    'readonly' => '1',
                    'class' => 'js-order-amount'
                ]
            ])
            ->add('user', SuggestType::class, [
                'required' => false,
                'suggester' => 'user',
                'attr' => [
                    'class' => 'form-control',

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
            ->add('status', 'choice', [
                'choices' => array_flip($this->statusLabels),
            ])
            ->add('amout')
            ->add('isPaid')

            ->addIdentifier('items', null, [
        //        'associated_property' => 'product'
                'template' => 'admin/order/fields/items.html.twig',
            ])
            ->add('email')
            ->add('phone')
            ->add('firstName')
            ->add('lastName');

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('status', 'doctrine_orm_choice', [
                'field_type' => ChoiceType::class,
                'field_options' => [
                    'choices' => $this->statusLabels,
                ]
            ])
            ->add('phone')
            ->add('firstName')
            ->add('lastName')
            ->add('email');

    }


    public function createQuery($context = 'list')
    {
        /**
         * @var QueryBuilder $query
         */
        $query =  parent::createQuery($context);

        list($rootAlias) = $query->getRootAliases();

        $query->andWhere($rootAlias.'.amout > 0');
        $query->leftJoin($rootAlias.'.items', 'i')->addSelect('i');
        $query->leftJoin('i.product', 'p')->addSelect('p');

        return $query;
    }


}
