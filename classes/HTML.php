<?php
	/**
	 * This class converts a few added HTML-Tags to existing HTML, so browsers understand.
	 */
	class HTML {
		
		private $code;
		private $html;
		private $tags = array(	'load' => '<div class="load"></div>', 
								'mainload' => '<iframe id="iframe_mainload" src="./templates/body/mainload.html" onAnimationFinished="onMainanimationEnded()"></iframe>');
		private $texts = array('name' => 'Anja Jorr&eacute; fotografiert');
		
		function __construct($string, $iframe=false) {
			$this->code = $string;
		}
		
		public function newTag($tagname, $htmlcode) {
			$this->tags[$tagname] = $htmlcode;
		}
		
		public function newText($textname, $text) {
			$this->texts[$textname] = $text;
		}
		
		public function generateHTML() {
			$this->html = $this->code;
			foreach ($this->tags as $tagname => $html) {
				$this->html = str_replace('<'.$tagname.'>', $html, $this->html);
			};
			foreach ($this->texts as $textname => $text) {
				$this->html = str_replace('['.$textname.']', $text, $this->html);
			};
		}
		
		public function getHTML() {
			$this->generateHTML();
			return $this->html;
		}
		
	}
	
?>