<?php

namespace Pagekit\Comment\Event;

use Pagekit\Comment\Event\CommentPersistEvent;
use Pagekit\Comment\Model\CommentEvents;
use Pagekit\Comment\Model\CommentInterface;
use Pagekit\Comment\SpamDetection\SpamDetectionInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * A listener that checks if a comment is spam based on a service that implements SpamDetectionInterface.
 */
class SpamDetectionListener implements EventSubscriberInterface
{
    /**
     * @var SpamDetectionInterface
     */
    protected $spamDetector;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @param SpamDetectionInterface $detector
     * @param LoggerInterface        $logger
     */
    public function __construct(SpamDetectionInterface $detector, LoggerInterface $logger = null)
    {
        $this->spamDetector = $detector;
        $this->logger = $logger;
    }

    public function spamCheck(CommentPersistEvent $event)
    {
        $comment = $event->getComment();

        if ($this->spamDetector->isSpam($comment)) {

            if (null !== $this->logger) {
                $this->logger->info('Comment is marked as spam from detector.');
            }

            $comment->setStatus(CommentInterface::STATUS_SPAM);
            $event->stopPropagation();
        }
    }

    public static function getSubscribedEvents()
    {
        return array(CommentEvents::PRE_PERSIST => 'spamCheck');
    }
}