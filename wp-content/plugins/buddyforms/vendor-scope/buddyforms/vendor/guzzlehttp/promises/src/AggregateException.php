<?php
 namespace tk\GuzzleHttp\Promise; class AggregateException extends \tk\GuzzleHttp\Promise\RejectionException { public function __construct($msg, array $reasons) { parent::__construct($reasons, \sprintf('%s; %d rejected promises', $msg, \count($reasons))); } } 