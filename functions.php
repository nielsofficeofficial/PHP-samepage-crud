<?php 

/**
 * @copyright (c) 2020-2021 PHP CRUD SAME PAGE v1.0 Cooked by nielsoffice
 *
 * PHP CRUD SAME PAGE v1.0 free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 * @category  PHP CRUD ON SAME PAGE
 * @package   - corePHP ( purePHP / no html for Back End PHP DEVELOPER/PROGRAMMER)
 *            - Read License and enjoy!
 *            
 * @author    nielfernandez <nieldigitalsolution@gmail.com>
 * @license   http://_source.org/licenses/gpl-3.0.html GNU Public License
 * @link      https://github.com/nielsofficeofficial/PHP-samepage-crud
 * @link      https://github.com/nielsofficeofficial/PHP-samepage-crud/blob/main/README.md
 * @link      https://www.facebook.com/nielsofficeofficial
 * @version   v1.0
 *
 */

require 'db.php';

/**
 *
 * Defined RequestConnection On Databaser
 * @since 03.19.21
 * @since v1.0
 *
 **/
 $serverRequest = new mysqli(
     SERVER_HOST_NAME
    ,SERVER_USER_NAME
    ,SERVER_PASSWORD
    ,SERVER_DB_TABLE
 );

/**
 *
 * Defined Check connection error
 * @since 03.19.21
 * @since v1.0
 *
**/
($serverRequest->connect_error) ? die("Connection failed: " . $serverRequest->connect_error) : true;

 /**
 *
 * Defined CRUD SAME PAGE PROCESS INSERT DATA TO DATABASE
 * @since 03.19.21
 * @since v1.0
 *
 **/
 if(isset($_REQUEST['insertData']) == true) :
  
  // sanitize user name Request Insert to database as string 
  // set to true remove special character cannot be insert
  $un = sanitizeRequest($_REQUEST['user_name'], true);

  // sanitize user email Request Insert to database as string 
  // set to true remove special character cannot be insert
  $ue = sanitizeRequest($_REQUEST['user_email']);
  
  // sanitize user contact Request Insert to database as string 
  // set to true remove special character cannot be insert
  $uc = sanitizeRequest($_REQUEST['user_contact'], true);

  // sanitize user social media Request Insert to database as string 
  // set to true remove special character cannot be insert
  $us = sanitizeRequest($_REQUEST['user_sm'], true);

  ($serverRequest->query("INSERT INTO 
      `friendlist` (
      `full_name`
      ,`email`
      ,`contact`
      ,`social_media`) VALUES ('$un', '$ue', '$uc', '$us')") == TRUE) ? $_SESSION['msg_handler'] = "New Data has been inserted! " : ("Error: ' . $serverRequest->error");
  
  // Return request same page
  redirectRequest("PHP-samepage-crud.php");

 endif;

 /**
 *
 * Defined CRUD SAME PAGE EDIT PROCESS DATA TO DATABASE
 * @since 03.19.21
 * @since v1.0
 *
 **/
// set update request return false default
$updateRequest = 0;

// Validate variable to be empty!
$unname    = $uemail = $uemail = $ucontact = $usocialm = "";

if (isset($_REQUEST['edit']) == true ) :

  $updateRequest  = true;  
  $idUserData     = $_REQUEST['edit'];
  
  $sqlRequest = returnSQL('EDIT_DATA_SAME_PAGE', '', $idUserData, true);
  $result     = $serverRequest->query($sqlRequest);
  $userData   = $result->fetch_assoc();
  
  // sanitize user name Request Insert to database as string 
  // set to true remove special character cannot be insert
  $unname = sanitizeRequest($userData['full_name'], true);

  // sanitize user email Request Insert to database as string 
  // set to true remove special character cannot be insert
  $uemail = sanitizeRequest($userData['email']);
  
  // sanitize user contact Request Insert to database as string 
  // set to true remove special character cannot be insert
  $ucontact = sanitizeRequest($userData['contact'], true);

  // sanitize user social media Request Insert to database as string 
  // set to true remove special character cannot be insert
  $usocialm = sanitizeRequest($userData['social_media'], true);

endif;

 /**
 *
 * Defined CRUD SAME PAGE SENT UPDATE PROCESS DATA TO DATABASE
 * @since 03.19.21
 * @since v1.0
 *
 **/
if(isset($_REQUEST['updateData']) == true ) : 

  // sanitize user name Request Insert to database as string 
  // set to true remove special character cannot be insert
  $un = sanitizeRequest($_REQUEST['user_name'], true);

  // sanitize user email Request Insert to database as string 
  // set to true remove special character cannot be insert
  $ue = sanitizeRequest($_REQUEST['user_email']);
  
  // sanitize user contact Request Insert to database as string 
  // set to true remove special character cannot be insert
  $uc = sanitizeRequest($_REQUEST['user_contact'], true);

  // sanitize user social media Request Insert to database as string 
  // set to true remove special character cannot be insert
  $us = sanitizeRequest($_REQUEST['user_sm'], true);

  ($serverRequest->query("UPDATE 
    `friendlist` SET 
     full_name    = '$un'
    ,email        = '$ue'
    ,contact      = '$uc'
    ,social_media = '$us' 
     WHERE id     = $idUserData") == TRUE) ? $_SESSION['msg_handler'] = "Data updated! " : ("Error: ' . $serverRequest->error");
 
  redirectRequest("PHP-samepage-crud.php");
 
endif;

 /**
 *
 * Defined CRUD SAME PAGE DELETE PROCESS DATA TO DATABASE
 * @since 03.19.21
 * @since v1.0
 *
 **/
if(isset($_REQUEST['delete']) == true) :

  $idRequest   = $_REQUEST['delete'];

  if($serverRequest->query("DELETE 
      FROM `friendlist` 
      WHERE id =  $idRequest") == TRUE) : $_SESSION['msg_handler'] = "Data Deleted! ";

   else : ("Error: ' . $serverRequest->error");
  
  endif;

  redirectRequest("PHP-samepage-crud.php");

endif;

 /**
 *
 * Defined CRUD SAME PAGE ADDING NEW PAGE REQ PROGRAM FILE
 * @since 03.19.21
 * @since v1.0
 *
 **/
 // USAGE
 // $testpage1 = "test";
 // PERFORM( ELEM('a','Link' ,setEA(['href'],["index.php?page=". $testpage1 .""])) );
 if( isset($_REQUEST['page']) == true ) : 

  require 'test1.php';

 endif; 

/**
 *
 * Defined OPTIMIZER set element attributes
 * @since 03.19.21
 * @since v1.0
 *
**/
function setEA(array $arrayAttrName, array $arrayValName)
{
 
    return $sets = [

      $attr_name = $arrayAttrName,
      $attr_val  = $arrayValName  
  
    ];

}

/**
 *
 * Defined SQL Query Request
 * @since 03.19.21
 * @since v1.0
 *
**/
function returnSQL(string $requestSQL = null, string $dbRequest = null, string $tableRequest = null, bool $activateString = false) 
{ 
    
    // Remove HTML & Special/Character
    $tableRequest = sanitizeRequest($tableRequest ,($activateString !== false) ? true : false);
    $dbRequest    = sanitizeRequest($dbRequest    ,($activateString !== false) ? true : false);

    switch ($requestSQL) : 

      case   'READ_DATA_SAME_PAGE':
      return "SELECT * FROM {$tableRequest}";
      break;

      case   'EDIT_DATA_SAME_PAGE':
      return "SELECT * FROM friendlist WHERE id = {$tableRequest}"; // id request instead
      break;
        
      default:
      return 'no SQL Query request!';
      break;

    endswitch;

}

/**
 *
 * Defined sanitize request into String | set true if remove special charac.
 * @since 03.19.21
 * @since v1.0
 * 
**/
function sanitizeRequest($dataRequest, bool $specialCharRemove = false ) 
{

   /**
    * sanitation source:
    * @source https://www.w3schools.com/php/php_form_validation.asp
    **/
    $dataRequest = trim($dataRequest);
    $dataRequest = stripslashes($dataRequest);
    $dataRequest = htmlspecialchars($dataRequest);
    
    return ($specialCharRemove == true ) ? preg_replace('/[^a-z0-9]/i', '', $dataRequest) : $dataRequest;

}

function redirectRequest(string $requestDirectory) : string
{
    return  header("location: {$requestDirectory}");
}

