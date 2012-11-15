<?php
require_once(dirname(__FILE__) . '/Swift/lib/swift_required.php');

class CMail {

	private $message;
	private $recipients;
	private $transport;
	private $mailer;

	/**
	* Creates an email
	* $from: the sender of the mail
	*	It can either be a string containing the email address of the sender ('john@doe.com')
	*   or an array to specify a name for the sender: array('john@doe.com' => 'John Doe')
	* $subject: the subject of the mail
	* $body: the content of the mail
	*/
	public function __construct($from, $subject, $bodyPlain, $bodyHTML = NULL) {
		$recipients = array();
		$this->mailer();

		// Create the message
		$this->message = Swift_Message::newInstance();
		// Set the From address with an associative array
		$this->message->setFrom($from);
		// Give the message a subject
		$this->message->setSubject($subject);
		// Give it a body (plain text)
		$this->message->setBody($bodyPlain, 'text/plain');
		// If an HTML body is given, set it
		if($bodyHTML) {
			$this->message->addPart($bodyHTML, 'text/html');
		}
	}

	public function addRecipient($mail, $name = NULL) {
		if($name) {
			$this->recipients[$mail] = $name;
		}
		else {
			$this->recipients[] = $mail;
		}
	}

	public function  mailer($smtp = 'localhost', $port=25, $username = NULL, $password = NULL, $overSSL = false) {
		// Create the Transport
		if($overSSL) {
			$this->transport = Swift_SmtpTransport::newInstance($smtp, $port, 'ssl');
		}
		else {
			$this->transport = Swift_SmtpTransport::newInstance($smtp, $port);
		}

		if($username != NULL) {
			$this->transport->setUsername($username);
		}
		if($password != NULL) {
  			$this->transport->setPassword($password);
		}
		// Create the Mailer using your created Transport
		$this->mailer = Swift_Mailer::newInstance($this->transport);
	}

	/**
	* Sends an email
	* $subject: the subject of the mail
	*/
	public function send() {

		// Set the To addresses with an associative array
		$this->message->setTo($this->recipients);

		/*
		// And optionally an alternative body
		->addPart('<q>Here is the message itself</q>', 'text/html')

		// Optionally add any attachments
		->attach(Swift_Attachment::fromPath('my-document.pdf'));
		*/
		$failedRecipients = array();
		try {
			$this->mailer->send($this->message, $failedRecipients);
		} catch(Swift_TransportException $e) {
			new BootstrapMessage('error', utf8_encode($e->getMessage()));
			return $this->recipients;
		}
		return $failedRecipients;
	}

}

?>