<?php

namespace Drupal\meta_generator_eraser\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Subscriber to remove the X-Generator header tag.
 */
class ResponseSubscriber implements EventSubscriberInterface {

  /**
   * Remove extra X-Generator header on response.
   *
   * @param ResponseEvent $event
   *   The event to process.
   */
  public function onRespond(ResponseEvent $event): void
  {
    if (!$event->isMainRequest()) {
      return;
    }

    $response = $event->getResponse();
    $response->headers->remove('X-Generator');
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array
  {
    $events[KernelEvents::RESPONSE][] = ['onRespond', -10];
    return $events;
  }

}
