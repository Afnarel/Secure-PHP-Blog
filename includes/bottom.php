<?php
$PAGE_CONTENT = ob_get_contents();
ob_end_clean();

Message::showMessages();

echo $PAGE_CONTENT;
?>

				<script src="http://code.jquery.com/jquery-latest.js"></script>
<?php
	// JS scripts
	foreach ($SCRIPTS as $script) {
		echo "\t\t\t\t<script src=\"" . ROOTPATH . 'js/' . $script . "\"></script>\n";
	}
?>
			</div>
		</div>
		<div id="bottom-text">Website created by François Chapuis &amp; Roman Mkrtchian</div>
    </body>
</html>