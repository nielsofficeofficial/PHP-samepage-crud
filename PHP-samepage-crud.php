<?php 
 
session_start(); 
 
require __DIR__ . '/library/PHPHtml-Optimizer/PHPHtml-Optimizer.php'; 
require __DIR__ . '/functions.php'; 
 
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
 **/ 

 USE \PHPHtml\CodeOptimizer\merge\Html;
 USE \PHPHtml\CodeOptimizer\optimizer\Html AS optimizer;
 USE \PHPHtml\CodeOptimizer\optimizer\Enhancers AS optimizerCare; 
 
 NEW optimizer();
 NEW optimizerCare();

 /**
 *
 *
 *
 *
 * Defined CRUD SAME PAGE READ DATA FROM DATABASE
 * @since 03.19.21
 * @since v1.0
 *
 *
 *
 *
 **/
 $sqlRequest = returnSQL('READ_DATA_SAME_PAGE', '', 'friendlist', true);
 $result     = $serverRequest->query($sqlRequest);

 _table(setEA(['border'],['1']),'tableData');
 
  if($result->num_rows > 0) :

    _xTR(
      ELEM('td','User ID')
     .ELEM('td','Name')
     .ELEM('td','Email')
     .ELEM('td','Contact')
     .ELEM('td','Social Media')
     .ELEM('td','Action')
 
    ); // End of TR html Optimizer

    // Display request Result
    while($row = $result->fetch_assoc()) :

     _xTR(
        ELEM('td', $row['id']) 
       .ELEM('td', $row['full_name']) 
       .ELEM('td', $row['email']) 
       .ELEM('td', $row['contact']) 
       .ELEM('td', $row['social_media']) 
       .ELEM('td', 
          ELEM('a','Edit'   ,setEA(['href'],["PHP-samepage-crud.php?edit="   .$row['id'].""])) . STRING(" | ", FUNC_ASSOC)
         .ELEM('a','Delete' ,setEA(['href'],["PHP-samepage-crud.php?delete=" .$row['id'].""]))
       ) 

     );

    endwhile; 

    else : PERFORM(" Add Friend to display your friend list! ");

  endif;

 xtable(" END of / tableData ");

 $serverRequest->close();

 /**
  *
  *
  *
  *
  * Defined CRUD SAME PAGE FORM INSERT DATA TO DATABASE
  * @since 03.19.21
  * @since v1.0
  *
  *
  *
  *
  **/
  _FORM(setEA(['action','method'],['','POST']),'insertData');

    _xdiv(
      ELEM('label','Name: ')
     .__HTML('Name','input'
     ,setEA(['type','name','value'],['text','user_name',"{$unname}"]),'user_name',null 
     
     ,FUNC_ASSOC)
    );
    _xdiv(
      ELEM('label','Email: ')
     .__HTML('Email','input'
     ,setEA(['type','name','value'],['text','user_email',"{$uemail}"]),'user_name',null 
     
     ,FUNC_ASSOC)
     );
    _xdiv(
     ELEM('label','Contact: ')
    .__HTML('Contact','input'
    ,setEA(['type','name','value'],['text','user_contact',"{$ucontact}"]),'user_contact',null 
    
    ,FUNC_ASSOC)
    );
    _xdiv(
      ELEM('label','Social Media: ')
     .__HTML('Social Media','input'
     ,setEA(['type','name','value'],['text','user_sm',"{$usocialm}"]),'user_sm',null 
     
     ,FUNC_ASSOC)
     );
    _xdiv(
       DOIF($updateRequest == true  ,ELEM('button',' Update Friend ' ,setEA(['type','name'],['submit','updateData'])), FUNC_ASSOC )
      .DOIF($updateRequest == false ,ELEM('button',' Add Friends '   ,setEA(['type','name'],['submit','insertData'])), FUNC_ASSOC)
     
    );

  xFORM(" END of / insertData ");
  
