<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompaniesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id');
        $builder->add('name');
        $builder->add('address');
        $builder->add('city');
        $builder->add('country');
        $builder->add('postcode');
        $builder->add('website');
        $builder->add('telephone');
        $builder->add('fax');
        $builder->add('video');
        $builder->add('risks_id');
        $builder->add('typecompanie_id');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Companies',
            'csrf_protection' => false
        ]);
    }
}