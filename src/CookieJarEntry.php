<?php

namespace Alc\Curl;

/**
 * CookieJarEntry
 */
class CookieJarEntry {

	private $domain;
	private $tailmatch;
	private $path;
	private $secure;
	private $expires;
	private $name;
	private $value;

	/**
	 * __construct
	 */
	public function __construct($domain, $tailmatch, $path, $secure, $expires, $name, $value ) {

		$this->setDomain($domain);
		$this->setTailmatch($tailmatch);
		$this->setPath($path);
		$this->setSecure($secure);
		$this->setExpires($expires);
		$this->setName($name);
		$this->setValue($value);
	}

	/**
	 * setDomain
	 *
	 * @param string domain
	 */
	public function setDomain($domain) {

		$this->domain = $domain;
	}

	/**
	 * setTailmatch
	 *
	 * @param string tailmatch
	 */
	public function setTailmatch($tailmatch) {

		$this->tailmatch = $tailmatch;
	}

	/**
	 * setPath
	 *
	 * @param string path
	 */
	public function setPath($path) {

		$this->path = $path;
	}

	/**
	 * setSecure
	 *
	 * @param string secure
	 */
	public function setSecure($secure) {

		$this->secure = $secure;
	}

	/**
	 * setExpires
	 *
	 * @param string expires
	 */
	public function setExpires($expires) {

		$this->expires = $expires;
	}

	/**
	 * setName
	 *
	 * @param string name
	 */
	public function setName($name) {

		$this->name = $name;
	}

	/**
	 * setValue
	 *
	 * @param string value
	 */
	public function setValue($value) {

		$this->value = $value;
	}

	/**
	 * getDomain
	 *
	 * @return string domain
	 */
	public function getDomain() {

		return $this->domain;
	}

	/**
	 * getTailmatch
	 *
	 * @return string tailmatch
	 */
	public function getTailmatch() {

		return $this->tailmatch;
	}

	/**
	 * getPath
	 *
	 * @return string path
	 */
	public function getPath() {

		return $this->path;
	}

	/**
	 * getSecure
	 *
	 * @return string secure
	 */
	public function getSecure() {

		return $this->secure;
	}

	/**
	 * getExpires
	 *
	 * @return string expires
	 */
	public function getExpires() {

		return $this->expires;
	}

	/**
	 * getName
	 *
	 * @return string name
	 */
	public function getName() {

		return $this->name;
	}

	/**
	 * getValue
	 *
	 * @return string value
	 */
	public function getValue() {

		return $this->value;
	}

	/**
	 * __toString
	 *
	 * @return string string
	 */
	public function __toString() {

		return implode("\t", array(
			$this->getDomain(),
			$this->getTailmatch(),
			$this->getPath(),
			$this->getSecure(),
			$this->getExpires(),
			$this->getName(),
			$this->getValue(),
		));
	}
}