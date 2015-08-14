<?php
// src/OAH/NewsBundle/Antispam/OAHAntispam.php

namespace OAH\NewsBundle\Antispam;

class OAHAntispam
{
	private $mailer;
	private $locale;
	private $minLengh;
	
	public function __contruct(\Swift_Mailer $mailer, $locale, $minLengh)
	{
		$this->mailer   = $mailer;
		$this->locale   = $locale;
		$this->minLengh = (int) $minLengh;
	}
	
  /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  public function isSpam($text)
  {
    return strlen($text) < $this->minLengh;
  }
}