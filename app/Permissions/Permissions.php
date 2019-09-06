<?php 
declare(strict_types=1) ;
namespace App\Permissions ;

/**
 * $table->smallInteger('installments')->length(2) ;  
          *  $table->smallInteger('users')->length(2) ;  
         *   $table->smallInteger('store')->length(2) ;  
        *    $table->smallInteger('customers')->length(2) ;  
       *     $table->smallInteger('custody')->length(2) ;  
      *      $table->smallInteger('roles')->length(2) ;  
     *       $table->smallInteger('sponsors')->length(2) ;  
    *        $table->smallInteger('reports')->length(2) ;  
   *         $table->smallInteger('operations_log')->length(2) ;   
 */
class Permissions {
    public static $PERMISSION_CREATE     = 0b00000001 ; 
    public static $PERMISSION_READ       = 0b00000010 ; 
    public static $PERMISSION_UPDATE     = 0b00000100 ;
    public static $PERMISSION_DELETE     = 0b00001000 ; 
    public static $PERMISSION_RESCHEDULE = 0b00010000 ; 
    public static $PERMISSION_SEARCH     = 0b00100000 ;

    public static $EMPLYEES       = 'users' ; 
    public static $INSTALLMENTS   = 'installments' ; 
    public static $STORE          = 'store' ; 
    public static $CUSTOMERS      = 'customers' ; 
    public static $CUSTODIS       = 'custody' ; 
    public static $ROLES          = 'roles' ; 
    public static $SPONSORS       = 'sponsors' ; 
    public static $REPORTS        = 'reports' ; 
    public static $OPERATIONS_LOG = 'operations_log' ; 

}
