<?php

namespace Alc\Curl;

/**
 * CookieJar
 */
class CookieJar {

	private $filename;
	private $entries;

	/**
	 * __construct
	 */
	public function __construct($filename) {

		$this->filename = $filename;

		$this->refresh();
	}

	/**
	 * parse
	 */
	protected function refresh() {

		$this->entries = array();

		$content = file_get_contents($this->filename);

		preg_match_all('/(.*)\t(.*)\t(.*)\t(.*)\t(.*)\t(.*)\t(.*)\n/i', $content, $matches);

		foreach( $matches[0] as $i => $match ) {

			$entry = new CookieJarEntry($matches[1][$i], $matches[2][$i], $matches[3][$i], $matches[4][$i], $matches[5][$i], $matches[6][$i], $matches[7][$i]);

			$this->entries[] = $entry;
		}
	}

	/**
	 * getEntries
	 *
	 * @return array<CookieJarEntry> entries
	 */
	public function getEntries() {

		return $this->entries;
	}

	/**
	 * save
	 */
	public function save() {

		$content = array();

		foreach($this->getEntries() as $entry) {

			$content[] = $entry->__toString();
		}

		file_put_contents($this->filename, implode("\n", $content)."\n");
	}
}