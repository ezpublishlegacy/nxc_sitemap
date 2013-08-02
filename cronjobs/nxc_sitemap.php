<?php

/**
 * @package nxcSitemap
 * @author  Alex Pilyavskiy <spi@nxc.no>
 * @date    2 Aug 2013
 **/

$cli->setUseStyles( true );
$cli->setIsQuiet($isQuiet);
$cli->output('Generating sitemap');

$nxcSitemap = new nxcSitemap('file', $cli );
$nxcSitemap->output();
$cli->output('!', true);



?>
