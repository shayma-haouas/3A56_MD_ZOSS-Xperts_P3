<?php



namespace App\Form;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('montant', null, [
            'constraints' => [
                new Assert\NotBlank,
                new Assert\Type(['type' => 'float']),
                new Assert\GreaterThan(['value' => 0]),
            ],
        ])
        ->add('datecmd')

        ->add('lieucmd', null, [
            'constraints' => [
                new Assert\NotBlank,
                new Assert\Length(['min' => 3]),
            ],
        ])
        ->add('quantite', null, [
            'constraints' => [
                new Assert\NotBlank,
                new Assert\Type(['type' => 'integer']),
                new Assert\GreaterThan(['value' => 0]),
            ],
        ])
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}





