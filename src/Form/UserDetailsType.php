<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\UserProfile;
use App\Enum\GenderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $entity = $builder->getData();

        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'empty_data' => $entity->getName(),
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(),
                    new Length(
                        min: 2,
                        max: 20,
                        minMessage: 'Your first name must be at least {{ limit }} characters long',
                        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
                    ),
                ],
            ])
            ->add('surname', TextType::class, [
                'required' => false,
                'empty_data' => $entity->getSurname(),
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(),
                    new Length(
                        min: 2,
                        max: 20,
                        minMessage: 'Your surname must be at least {{ limit }} characters long',
                        maxMessage: 'Your surname cannot be longer than {{ limit }} characters',
                    ),
                ],
            ])
            ->add('age', IntegerType::class, [
                'required' => false,
                'empty_data' => $entity->getAge(),
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('gender', EnumType::class, [
                'required' => false,
                'class' => GenderType::class,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('weight', NumberType::class, [
                'required' => false,
                'empty_data' => $entity->getWeight(),
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('height', NumberType::class, [
                'required' => false,
                'empty_data' => $entity->getHeight(),
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mb-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
        ]);
    }
}
