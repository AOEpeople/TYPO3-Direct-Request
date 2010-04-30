<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 AOE media (dev@aoemedia.de)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class that manages direct requests.
 */
class tx_directrequest_manager implements t3lib_Singleton {
	/**
	 * @var array
	 */
	protected $extensionSettings;

	/**
	 * Constructs this object.
	 */
	public function __construct() {
		$this->extensionSettings = (array) unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['directrequest']);
	}

	/**
	 * Executes a direct request.
	 *
	 * @param string $url The full qualified URL to be requested
	 * @param array $headers Additions HTTP headers to transferred along
	 * @return array The result with contents, response and request headers
	 */
	public function execute($url, array $headers = NULL) {
		$command = $this->getShellCommand($url);
		$content = $this->executeShellCommand($command);

		$result = array(
			'content' => $content,
			'request' => '',
			'response' => '',
		);

		return $result;
	}

	/**
	 * Generates the shell command that is executed to perform the request.
	 *
	 * @param string $url The full qualified URL to be requested
	 * @param array $headers Additions HTTP headers to transferred along
	 * @return string The command string
	 */
	protected function getShellCommand($url, array $headers = NULL) {
		$commandParts = array(
			escapeshellcmd($this->getPhpPath()),
			escapeshellarg(t3lib_extMgm::extPath('directrequest') . 'cli/request.php'),
			escapeshellarg($this->getFrontendBasePath()),
			escapeshellarg($url),
			escapeshellarg(base64_encode(serialize($headers))),
		);

		$command = trim(implode(' ', $commandParts));

		return $command;
	}

	/**
	 * Executes a shell command and returns the outputted result.
	 *
	 * @param string $command Shell command to be executed
	 * @return string Outputted result of the command execution
	 */
	protected function executeShellCommand($command) {
		$result = shell_exec($command);
		return $result;
	}

	/**
	 * Gets the path to the PHP executable.
	 *
	 * @return string Path to the PHP executable
	 */
	protected function getPhpPath() {
		$phpPath = 'php';

		if (isset($this->extensionSettings['phpPath']) && $this->extensionSettings['phpPath']) {
			$phpPath = $this->extensionSettings['phpPath'];
		}

		return $phpPath;
	}

	/**
	 * Gets the base path of the website frontend.
	 * (e.g. if you call http://mydomain.com/cms/index.php in
	 * the browser the base path is "/cms/")
	 *
	 * @return string Base path of the website frontend
	 */
	protected function getFrontendBasePath() {
		$frontendBasePath = '/';

		// Get the path from the extension settings:
		if (isset($this->extensionSettings['frontendBasePath']) && $this->extensionSettings['frontendBasePath']) {
			$frontendBasePath = $this->extensionSettings['frontendBasePath'];
		// If not in CLI mode the base path can be determined from $_SERVER environment:
		} elseif (!defined('TYPO3_cliMode') || !TYPO3_cliMode) {
			t3lib_div::getIndpEnv('TYPO3_SITE_PATH');
		}

		// Base path must be '/<pathSegements>/':
		if ($frontendBasePath != '/') {
			$frontendBasePath = '/' . ltrim($frontendBasePath, '/');
			$frontendBasePath = rtrim($frontendBasePath, '/') . '/';
		}

		return $frontendBasePath;
	}
}