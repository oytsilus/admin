<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom config : sayur
 *
 * @author      Agung SW (agung.sulistyo.w@gmail.com)
 **/

/*
| -----------------------------------------------------------------
|						LEVELS AND ROLES							
| -----------------------------------------------------------------
| This definition sets the levels and roles that will be used for authentication.
| 
| Keep in mind that if you use key numbering higher than 255,  
| the auth_level field of the users table will need to be changed
| to smallint, or another integer datatype that handles larger numbers.
|
| No user level should ever be set with a key of 0.
|
*/

$config['kategori_sayur'] = [
	'SAYUR' => 'Sayur',
	'BUAH' => 'Buah'
];
$config['ppn'] = 10;
$config['ppn_txt'] = $config['ppn'].'%';

$config['po_prefix'] = 'PO'; // Purchase Order
$config['invoice_prefix'] = 'INV'; // Invoice
$config['receiving_prefix'] = 'RI'; // Receiving Item
$config['pp_prefix'] = 'PP'; // Purchase Payment

$config['order_prefix'] = 'SO'; // Sales Order
$config['order_inv_prefix'] = 'INV'; // Invoice
$config['delivery_prefix'] = 'SJ'; // Delivery
$config['op_prefix'] = 'OP'; // Sales Payment

/* Company Credential */
$config['company_name'] = 'Ibu Atie';
$config['company_up'] = 'Ibu Atie';
$config['company_address'] = 'Perumahan Persada Kemala Blok 28 No.4 Bekasi';
$config['company_phone'] = '(021) 123456';
$config['company_fax'] = '(021) 222456';
$config['company_email'] = 'company@email.com';
$config['company_prepared_by'] = 'Ibu Atie';