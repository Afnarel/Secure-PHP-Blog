<?php

class Message
{
	protected $message;
	protected $type;
	private $closeButton;
	private $heading;

	public function __construct($type, $message, $closeButton = false, $heading = NULL)
	{
		$this->type = $type;
		$this->message = $message;
		$this->closeButton = $closeButton;
		$this->heading = $heading;

		if($this->type == NULL) {
			$this->type = 'info';
		}

		if(!in_array($type, array('info', 'success', 'error'))) {
			throw new Exception("This kind of message does not exist: $type");
		}

		if (!isset($_SESSION['Message_list']))
		{
			$_SESSION['Message_list'] = array();
		}

		$_SESSION['Message_list'][] = $this;
	}

	public function show() {
		$messageClass = 'alert fade in';
		$before = '';
		if(in_array($this->type, array('error', 'success'))) {
			$messageClass .= ' alert-' . $this->type;
		}

		if($this->closeButton) {
			$before = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>\n";
		}
		if(is_string($this->heading)) {
			$messageClass .= ' alert-block';
			$before .= "<h4 class=\"alert-heading\">$this->heading</h4>\n";
		}

		$this->message = $before . $this->message;

		echo "\t<div class=\"$messageClass\">$this->message</div>\n";
	}

	public static function showMessages()
	{
		if (isset($_SESSION['Message_list']))
		{
			$t = &$_SESSION['Message_list'];

			if (count($t) > 0)
			{
				echo "<div class= \"messages\">\n";
				
				do
				{
					//array_pop($t)->show();
					array_shift($t)->show();
				} while (count($t) > 0);

				echo "</div>\n";
			}
		}
	}
}
?>