<?php

namespace App\Form\Admin;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment')
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $picture = $event->getData();
                $form = $event->getForm();

                if (!$picture || null === $picture->getId()) {
                    $form->add('image', FileType::class);
                }
                else {
                    $form->add('image', FileType::class, array('required' => false));
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
            'translation_domain' => 'forms'
        ]);
    }
}
