<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class)
            ->add('last_name', TextType::class)
            ->add('phone', TelType::class)
            ->add('email', EmailType::class)
            ->add('education', ChoiceType::class, [
                'choices' => [
                    'Высшее образование' => 'Высшее образование',
                    'Специальное образование' => 'Специальное образование',
                    'Среднее образование' => 'Среднее образование',
                ],
                ])
            ->add('is_accept_data', CheckboxType::class, [
                'label'=> 'Я даю согласие на обработку моих личных данных',
                'required'=> false
            ])
            ->add('save', SubmitType::class, array('label' => 'Отправить'))
            ->getForm();
        ;
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
