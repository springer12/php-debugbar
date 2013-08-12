<?php

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/../../bootstrap.php';

$debugbarRenderer->setBaseUrl('../../../src/DebugBar/Resources');

use DebugBar\Bridge\SwiftMailer\LogCollector;
use DebugBar\Bridge\SwiftMailer\MessagesCollector;

$mailer = Swift_Mailer::newInstance(Swift_NullTransport::newInstance());

$debugbar['messages']->aggregate(new LogCollector($mailer));
$debugbar->addCollector(new MessagesCollector($mailer));

$message = Swift_Message::newInstance('Wonderful Subject')
  ->setFrom(array('john@doe.com' => 'John Doe'))
  ->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))
  ->setBody('Here is the message itself');

$mailer->send($message);


render_demo_page();