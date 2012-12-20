<?php

class UFCOE_Testable_Plugin {
	public $path = '';
	public $simpletestPath = '';
	public $simpletestBootstrap = '';
	public $phpunitPath = '';
	public $phpunitBootstrap = '';

	public function getSimpletestFiles() {
		$files = array();
		if ($this->simpletestPath) {
			$di = new RecursiveDirectoryIterator($this->simpletestPath);
			foreach (new RecursiveIteratorIterator($di) as $fileInfo) {
				/* @var SplFileInfo $fileInfo */
				$fileInfo->isFile();
				if (preg_match('~Test\\.php$~', $fileInfo->getBasename())) {
					$files[] = $fileInfo->getPathname();
				}
			}
		}
		return $files;
	}

	public function getPhpunitFiles() {
		$files = array();
		if ($this->phpunitPath) {
			$di = new RecursiveDirectoryIterator($this->phpunitPath);
			foreach (new RecursiveIteratorIterator($di) as $fileInfo) {
				/* @var SplFileInfo $fileInfo */
				$fileInfo->isFile();
				if (preg_match('~^Test.*\\.php$~', $fileInfo->getBasename())) {
					$files[] = $fileInfo->getPathname();
				}
			}
		}
		return $files;
	}
}
