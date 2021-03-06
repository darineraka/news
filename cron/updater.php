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


namespace OCA\News\Cron;

use \OCA\News\AppInfo\Application;


class Updater {


    public static function run() {
        $app = new Application();

        $container = $app->getContainer();

        // make it possible to turn off cron updates if you use an external
        // script to execute updates in parallel
        if ($container->query('OCA\News\Config\Config')->getUseCronUpdates()) {
            $container->query('OCA\News\Utility\Updater')->beforeUpdate();
            $container->query('OCA\News\Utility\Updater')->update();
            $container->query('OCA\News\Utility\Updater')->afterUpdate();
        }
    }


}
