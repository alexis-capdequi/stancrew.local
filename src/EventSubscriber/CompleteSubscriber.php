<?php

namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CompleteSubscriber implements EventSubscriber
{   
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist
        ];
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $class_name = str_replace('App\Entity\\', '', get_class($entity));
        
        if (in_array($class_name, array('Picture', 'Video', 'Music'))){
            $entity
                ->setUniqid(uniqid())
                ->setPublicationDate(new \DateTime());
        }
        elseif($class_name == 'Message') {
            $entity->setSendingDate(new \DateTime());
        }
    }
}