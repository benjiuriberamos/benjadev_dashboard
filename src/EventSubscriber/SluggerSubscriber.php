<?php

namespace App\EventSubscriber;

use App\Entity\Producto;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class SluggerSubscriber implements EventSubscriberInterface
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['createProductoSlug'],
            BeforeEntityUpdatedEvent::class => ['updateProductoSlug'],
        ];
    }

    public function createProductoSlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Producto)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getNombre());
        $slug = strtolower($slug);
        $entity->setSlug($slug);
    }

    public function updateProductoSlug(BeforeEntityUpdatedEvent $event)
    {
        // dump(1); exit;
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Producto)) {
            return;
        }
        // dump($entity->getNombre());exit;

        // if (!$entity->getSlug()) {
            $slug = $this->slugger->slug($entity->getNombre());
            $slug = strtolower($slug);
            $entity->setSlug($slug);
        // }
    }
}