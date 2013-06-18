<?php
require_once( 'kernel/common/template.php' );
$ini = eZINI::instance('nxc_sitemap.ini');
$ClassFilterType = $ini->variable('Classes','Class_Filter_Type');
$ClassFilterArray = $ini->variable('Classes','Class_Filter_Array');
$MainNodeOnly = $ini->variable('NodeSettings','Main_Node_Only');
$nodeID = $Params['nodeID'];
$limit = 15;
$offset = 0;
$counter = 0;

if( !isset( $nodeID ) ){
        $nodeID = 2;
}

//$startTime = microtime( true );

header("Content-Type: text/xml");
$tpl = templateInit();
$result = "<?xml version='1.0' encoding='UTF-8'?><urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>";

do {
    $nodes = array();
    $nodes = eZContentObjectTreeNode::subTreeByNodeID(
        array(
                'Depth'           => 5,
                'Limit'           => $limit,
                'Offset'          => $offset,
                'LoadDataMap'     => false,
                'ClassFilterType' => $ClassFilterType,
                'ClassFilterArray'=> $ClassFilterArray,
                'Main_Node_Only'  => $Main_Node_Only
        ),
        $nodeID
    );
    $offset += $limit;
    foreach( $nodes as $key => $node ) {
        $tpl->resetVariables();
        $tpl->setVariable( 'node', $node );
        $result .= $tpl->fetch( 'design:node/view/nxc_sitemap.tpl' );
        $object = $node->attribute( 'object' );
        eZContentObject::clearCache( $object->attribute( 'id' ) );
        $object->resetDataMap();
    }
} while (count($nodes));

//$memoryUsage = number_format( memory_get_usage( true ) / ( 1024 * 1024 ), 2 );
//$executionTime = round( microtime( true ) - $startTime, 2 );
//$result .= $memoryUsage. ' MB ' . 'time' . $executionTime;

$result .= "</urlset>";
echo $result;
eZExecution::cleanExit();
?>