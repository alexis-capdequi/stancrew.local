<?php

namespace App\Form\Admin;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('link')
            ->add('description')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'preview' => 'preview',
                    'clip' => 'clip',
                    'concert' => 'concert'
                ]
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $video = $event->getData();
                $form = $event->getForm();

                if (!$video || null === $video->getId()) {
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
            'data_class' => Video::class,
        ]);
    }
}
