<?php
//Copyright 2021 - Kyle Johnson
/* This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

//Tools for the site

//Function to create error return message
//Param:
// $strMsg = Extra information
function getErorrJsonMessage( $strMsg)
{
	$msg = array('success'=>false, 'message'=> $strMsg);
	return (json_encode($msg));
}

//Function to create error return message
//Param:
// $infoArray = array of records
// $strMsg = Extra information
function getSuccessJsonMessage( $strMsg, $infoArray )
{
    $msg = array('success'=>true, 'result'=>$infoArray, 'message'=> $strMsg);
	return (json_encode($msg));
}

?>