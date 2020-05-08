<?php


namespace App\EventSubscriber;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{
    /**
     * @var CacheManager
     */
    private $cacheManager;
    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {

        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preUpdate,
            Events::preRemove
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $class_name = str_replace('App\Entity\\', '', get_class($entity));

        if (!in_array($class_name, array('Picture', 'Video'))){
            return;
        }

        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'image'));
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $class_name = str_replace('App\Entity\\', '', get_class($entity));

        if (!in_array($class_name, array('Picture', 'Video'))){
            return;
        }

        if ($entity->getImage() instanceof UploadedFile) {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'image'));
        }
    }

    private function logActivity(string $action, LifecycleEventArgs $args)
    {

    }
}