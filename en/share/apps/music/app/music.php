<?php

/**
 * ownCloud - Music app
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Morris Jobke <hey@morrisjobke.de>
 * @copyright Morris Jobke 2014
 */


namespace OCA\Music\App;

use \OCP\AppFramework\App;

use \OCA\Music\AppFramework\Core\Logger;

use \OCA\Music\BusinessLayer\AlbumBusinessLayer;
use \OCA\Music\BusinessLayer\ArtistBusinessLayer;
use \OCA\Music\BusinessLayer\TrackBusinessLayer;

use \OCA\Music\Controller\AmpacheController;
use \OCA\Music\Controller\ApiController;
use \OCA\Music\Controller\LogController;
use \OCA\Music\Controller\PageController;
use \OCA\Music\Controller\PlaylistApiController;
use \OCA\Music\Controller\SettingController;

use \OCA\Music\DB\AlbumMapper;
use \OCA\Music\DB\AmpacheSessionMapper;
use \OCA\Music\DB\AmpacheUserMapper;
use \OCA\Music\DB\ArtistMapper;
use \OCA\Music\DB\PlaylistMapper;
use \OCA\Music\DB\TrackMapper;

use \OCA\Music\Middleware\AmpacheMiddleware;

use \OCA\Music\Utility\AmpacheUser;
use \OCA\Music\Utility\ExtractorGetID3;
use \OCA\Music\Utility\Helper;
use \OCA\Music\Utility\Scanner;
use OCP\AppFramework\IAppContainer;

// in stable5 getid3 is already loaded
if(!class_exists('getid3_exception')) {
	require_once __DIR__ . '/../3rdparty/getID3/getid3/getid3.php';
}

class Music extends App {

	public function __construct(array $urlParams=array()){
		parent::__construct('music', $urlParams);

		$container = $this->getContainer();

		/**
		 * Controllers
		 */
		$container->registerService('AmpacheController', function($c) {
			return new AmpacheController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('L10N'),
				$c->query('URLGenerator'),
				$c->query('AmpacheUserMapper'),
				$c->query('AmpacheSessionMapper'),
				$c->query('AlbumMapper'),
				$c->query('ArtistMapper'),
				$c->query('TrackMapper'),
				$c->query('AmpacheUser'),
				$c->query('RootFolder')
			);
		});

		$container->registerService('ApiController', function($c) {
			return new ApiController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('URLGenerator'),
				$c->query('TrackBusinessLayer'),
				$c->query('ArtistBusinessLayer'),
				$c->query('AlbumBusinessLayer'),
				$c->query('Scanner'),
				$c->query('UserId'),
				$c->query('L10N'),
				$c->query('UserFolder')
			);
		});

		$container->registerService('PageController', function($c) {
			return new PageController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('L10N'),
				$c->query('Scanner')
			);
		});

		$container->registerService('PlaylistApiController', function($c) {
			return new PlaylistApiController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('PlaylistMapper'),
				$c->query('UserId')
			);
		});

		$container->registerService('LogController', function($c) {
			return new LogController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('Logger')
			);
		});

		$container->registerService('SettingController', function($c) {
			return new SettingController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('AmpacheUserMapper'),
				$c->query('Scanner'),
				$c->query('UserId'),
				$c->query('UserFolder'),
				$c->query('Config')
			);
		});

		/**
		 * Business Layer
		 */

		$container->registerService('TrackBusinessLayer', function($c) {
			return new TrackBusinessLayer(
				$c->query('TrackMapper'),
				$c->query('Logger')
			);
		});

		$container->registerService('ArtistBusinessLayer', function($c) {
			return new ArtistBusinessLayer(
				$c->query('ArtistMapper'),
				$c->query('Logger')
			);
		});

		$container->registerService('AlbumBusinessLayer', function($c) {
			return new AlbumBusinessLayer(
				$c->query('AlbumMapper'),
				$c->query('Logger')
			);
		});

		/**
		 * Mappers
		 */

		$container->registerService('AlbumMapper', function(IAppContainer $c) {
			return new AlbumMapper(
				// TODO: replace this with IDBConnection (only 8.1+)
				$c->getServer()->getDb()
			);
		});

		$container->registerService('AmpacheSessionMapper', function(IAppContainer $c) {
			return new AmpacheSessionMapper(
				// TODO: replace this with IDBConnection (only 8.1+)
				$c->getServer()->getDb()
			);
		});

		$container->registerService('AmpacheUserMapper', function(IAppContainer $c) {
			return new AmpacheUserMapper(
				// TODO: replace this with IDBConnection (only 8.1+)
				$c->getServer()->getDb()
			);
		});

		$container->registerService('ArtistMapper', function(IAppContainer $c) {
			return new ArtistMapper(
				// TODO: replace this with IDBConnection (only 8.1+)
				$c->getServer()->getDb()
			);
		});

		$container->registerService('PlaylistMapper', function(IAppContainer $c) {
			return new PlaylistMapper(
				// TODO: replace this with IDBConnection (only 8.1+)
				$c->getServer()->getDb()
			);
		});

		$container->registerService('TrackMapper', function(IAppContainer $c) {
			return new TrackMapper(
				// TODO: replace this with IDBConnection (only 8.1+)
				$c->getServer()->getDb()
			);
		});

		/**
		 * Core
		 */

		$container->registerService('Config', function($c){
			return $c->getServer()->getConfig();
		});

		$container->registerService('Db', function(IAppContainer $c) {
			return $c->getServer()->getDatabaseConnection();
		});

		$container->registerService('L10N', function($c) {
			return $c->query('ServerContainer')->getL10N($c->query('AppName'));
		});

		$container->registerService('Logger', function($c) {
			return new Logger(
				$c->query('AppName')
			);
		});

		$container->registerService('URLGenerator', function($c) {
			return $c->getServer()->getURLGenerator();
		});

		$container->registerService('UserFolder', function($c){
			return $c->getServer()->getUserFolder();
		});

		$container->registerService('RootFolder', function($c){
			return $c->getServer()->getRootFolder();
		});

		$container->registerService('UserId', function() {
			return \OCP\User::getUser();
		});

		/**
		 * Utility
		 */

		$container->registerService('AmpacheUser', function() {
			return new AmpacheUser();
		});

		$container->registerService('ExtractorGetID3', function($c) {
			return new ExtractorGetID3(
				$c->query('getID3'),
				$c->query('Logger')
			);
		});

		$container->registerService('getID3', function() {
			$getID3 = new \getID3();
			$getID3->encoding = 'UTF-8';
			// On 32-bit systems, getid3 tries to make a 2GB size check,
			// which does not work with fopen. Disable it.
			// Therefore the filesize (determined by getID3) could be wrong
			// (for files over ~2 GB) but this isn't used in any way.
			$getID3->option_max_2gb_check = false;
			return $getID3;
		});

		$container->registerService('Helper', function(IAppContainer $c) {
			return new Helper(
				$c->query('Db')
			);
		});

		$container->registerService('Scanner', function($c) {
			return new Scanner(
				$c->query('ExtractorGetID3'),
				$c->query('ArtistBusinessLayer'),
				$c->query('AlbumBusinessLayer'),
				$c->query('TrackBusinessLayer'),
				$c->query('Logger'),
				$c->query('Db'),
				$c->query('UserId'),
				$c->query('Config'),
				$c->query('AppName'),
				$c->query('UserFolder')
			);
		});

		/**
		 * Middleware
		 */

		$container->registerService('AmpacheMiddleware', function($c) {
			return new AmpacheMiddleware(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('AmpacheSessionMapper'),
				$c->query('AmpacheUser')
			);
		});

		$container->registerMiddleWare('AmpacheMiddleware');

	}
}
