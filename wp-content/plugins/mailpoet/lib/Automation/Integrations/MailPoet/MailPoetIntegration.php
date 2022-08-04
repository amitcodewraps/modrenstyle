<?php declare(strict_types = 1);

namespace MailPoet\Automation\Integrations\MailPoet;

if (!defined('ABSPATH')) exit;


use MailPoet\Automation\Engine\Integration;
use MailPoet\Automation\Engine\Registry;
use MailPoet\Automation\Integrations\MailPoet\Actions\SendEmailAction;
use MailPoet\Automation\Integrations\MailPoet\Subjects\SegmentSubject;
use MailPoet\Automation\Integrations\MailPoet\Subjects\SubscriberSubject;
use MailPoet\Automation\Integrations\MailPoet\Triggers\SegmentSubscribedTrigger;

class MailPoetIntegration implements Integration {
  /** @var SegmentSubject */
  private $segmentSubject;

  /** @var SubscriberSubject */
  private $subscriberSubject;

  /** @var SegmentSubscribedTrigger */
  private $segmentSubscribedTrigger;

  /** @var SendEmailAction */
  private $sendEmailAction;

  public function __construct(
    SegmentSubject $segmentSubject,
    SubscriberSubject $subscriberSubject,
    SegmentSubscribedTrigger $segmentSubscribedTrigger,
    SendEmailAction $sendEmailAction
  ) {
    $this->segmentSubject = $segmentSubject;
    $this->subscriberSubject = $subscriberSubject;
    $this->segmentSubscribedTrigger = $segmentSubscribedTrigger;
    $this->sendEmailAction = $sendEmailAction;
  }

  public function register(Registry $registry): void {
    $registry->addSubject($this->segmentSubject);
    $registry->addSubject($this->subscriberSubject);
    $registry->addTrigger($this->segmentSubscribedTrigger);
    $registry->addAction($this->sendEmailAction);
  }
}
