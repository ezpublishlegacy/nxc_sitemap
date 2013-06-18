<?php
//
// Created on: <20-Jan-2006>
//
// Name   : GoogleSiteMaps Extension
// Version: 0.1
// Author : Sergey A. Shishkin
// Date   : 20.01.2006
// URL    : http://www.competent.name/
// e-mail : classic.ru@gmail.com
// ICQ    : #28582606
//

/*! \file ezextlinkfixoperator.php
*/

/*!
  \class eZExtLinkFixOperator ezextlinkfixoperator.php
*/

include_once( "lib/ezutils/classes/ezdebug.php" );

class eZExtLinkFixOperator
{
    /*!
     Initializes the object with the name $name, default is "extlinkfix".
    */
    function eZExtLinkFixOperator( $name = "extlinkfix" )
    {
		$this->Operators = array( $name );
    }

    /*!
	 Returns the template operators.
    */
    function &operatorList()
    {
		return $this->Operators;
    }

    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
    	// eZDebug::writeDebug( $operatorParameters );
    	$type = $operatorParameters[0][0][1];
    	eZDebug::writeNotice( $type );
    	//array of params in which each param is an array of length 3
    	switch( $type )
	   	{
	   	case "del_layout":
	   		$fixedlink = str_replace("/layout/set/googlesitemap", "", $operatorValue);
	   		break; 		
		default:
			$fixedlink = $operatorValue;
        }

       	$operatorValue = $fixedlink;
    }
    
    var $Operators;
}




?>
