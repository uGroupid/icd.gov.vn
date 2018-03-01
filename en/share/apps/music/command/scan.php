<?php

/**
 * ownCloud - Music app
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 * @author Bart Visscher <bartv@thisnet.nl>
 * @author Leizh <leizh@free.fr>
 * @copyright Thomas Müller 2013
 * @copyright Bart Visscher 2013
 * @copyright Leizh 2014
 */

namespace OCA\Music\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


use OCA\Music\Utility\Scanner;

class Scan extends Command {
	/**
	 * @var \OCP\IUserManager $userManager
	 */
	private $userManager;
	/**
	 * @var  Scanner
	 */
	private $scanner;
	/**
	 * @var \OCP\Files\Folder $rootFolder
	 */
	private $rootFolder;

	public function __construct(\OCP\IUserManager $userManager, $scanner, \OCP\Files\Folder $rootFolder) {
		$this->userManager = $userManager;
		$this->scanner = $scanner;
		$this->rootFolder = $rootFolder;
		parent::__construct();
	}

	protected function configure() {
		$this
			->setName('music:scan')
			->setDescription('rescan music')
			->addArgument(
					'user_id',
					InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
					'will rescan all music files of the given user(s)'
			)
			->addOption(
					'all',
					null,
					InputOption::VALUE_NONE,
					'will rescan all music files of all known users'
			)
			->addOption(
					'debug',
					null,
					InputOption::VALUE_NONE,
					'will run the scan in debug mode (memory usage)'
			)
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		if (!$input->getOption('debug')) {
			$this->scanner->listen('\OCA\Music\Utility\Scanner', 'update', function($path) use ($output) {
				$output->writeln("Scanning <info>$path</info>");
			});
		}

		if ($input->getOption('all')) {
			$users = $this->userManager->search('');
		} else {
			$users = $input->getArgument('user_id');
		}

		foreach ($users as $user) {
			if (is_object($user)) {
				$user = $user->getUID();
			}
			\OC_Util::tearDownFS();
			\OC_Util::setupFS($user);
			$output->writeln("Start scan for <info>$user</info>");
			$this->scanner->rescan($user, true, $this->resolveUserFolder($user), $input->getOption('debug'), $output);
		}
	}

	private function resolveUserFolder($userId) {
		$dir = '/' . $userId;
		$root = $this->rootFolder;

		// copy of getUserServer of server container
		$folder = null;

		if (!$root->nodeExists($dir)) {
			$folder = $root->newFolder($dir);
		} else {
			$folder = $root->get($dir);
		}

		$dir = '/files';
		if (!$folder->nodeExists($dir)) {
			$folder = $folder->newFolder($dir);
		} else {
			$folder = $folder->get($dir);
		}

		return $folder;
	}
}
