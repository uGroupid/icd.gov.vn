<?php
/**
 * ownCloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Alessandro Cosentino <cosenal@gmail.com>
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright Alessandro Cosentino 2012
 * @copyright Bernhard Posselt 2012, 2014
 */

namespace OCA\News\Admin;

use OCA\News\AppInfo\Application;
use OCA\News\Controller\AdminController;

$app = new Application();
$container = $app->getContainer();
$response = $container->query(AdminController::class)->index();

return $response->render();
