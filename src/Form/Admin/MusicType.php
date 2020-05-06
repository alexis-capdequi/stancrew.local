<?php

namespace App\Form\Admin;

use App\Entity\Music;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $picture = $event->getData();
                $form = $event->getForm();

                if (!$picture || null === $picture->getId()) {
                    $form->add('mp3File', FileType::class);
                }
                else {
                    $form->add('mp3File', FileType::class, array('required' => false));
                }
            })
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $picture = $event->getData();
                $form = $event->getForm();

                if (!$picture || null === $picture->getId()) {
                    $form->add('oggFile', FileType::class);
                }
                else {
                    $form->add('oggFile', FileType::class, array('required' => false));
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Music::class,
        ]);
    }
}
