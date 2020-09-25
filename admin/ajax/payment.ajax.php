<?php

// includes and security
include_once('../_local_auth.inc.php');

$iDisplayLength = (int) $_REQUEST['iDisplayLength'];
$iDisplayStart  = (int) $_REQUEST['iDisplayStart'];
$sSortDir_0     = $_REQUEST['sSortDir_0'] ? $_REQUEST['sSortDir_0'] : "desc";
$filterText     = $_REQUEST['filterText'] ? $_REQUEST['filterText'] : null;
$filterUserId   = $_REQUEST['filterUserId'] ? $_REQUEST['filterUserId'] : null;

// get sorting columns
$iSortCol_0     = (int) $_REQUEST['iSortCol_0'];
$sColumns       = trim($_REQUEST['sColumns']);
$arrCols        = explode(",", $sColumns);
$sortColumnName = $arrCols[$iSortCol_0];
$sort           = 'date_created';
switch ($sortColumnName)
{
    case 'payment_date':
        $sort = 'created_at';
        break;
    case 'user_name':
        $sort = 'users.username';
        break;
    case 'amount':
        $sort = 'amount';
        break;
}

$sqlClause = "WHERE 1=1 ";
if ($filterText)
{
    $filterText = $db->escape($filterText);
    $sqlClause .= "AND (users.username LIKE '%" . $filterText . "%' OR ";
    $sqlClause .= "description LIKE '%" . $filterText . "%' OR ";
    $sqlClause .= "from_email LIKE '%" . $filterText . "%')";
}

if (strlen($filterByUser))
{
    $sqlClause .= " AND user_id = " . (int)$filterByUser;
}

if(strlen($filterUserId))
{
    $sqlClause .= " AND user_id = " . (int)$filterUserId;
}

$totalRS   = $db->getValue("SELECT COUNT(payment_laser.pay_id) AS total FROM payment_laser");
// $limitedRS = $db->getRows("SELECT payment_laser.user_id,payment_laser.pay_id, payment_laser.created_at, payment_laser.order_id, payment_laser.payment_id,payment_laser.status,payment_laser.ammount FROM payment_laser");

$limitedRS = $db->getRows("SELECT payment_laser.pay_id, payment_laser.created_at, payment_laser.order_id, payment_laser.payment_id,payment_laser.status,payment_laser.ammount, user_member.name, user_member.id AS user_id FROM payment_laser LEFT JOIN user_member ON payment_laser.user_id = user_member.id " . $sqlClause . " ORDER BY " . $sort . " " . $sSortDir_0 . " LIMIT " . $iDisplayStart . ", " . $iDisplayLength);

$data = array();
if (COUNT($limitedRS) > 0)
{
    // echo "<pre>";
    // print_r($limitedRS);die();
    foreach ($limitedRS AS $row)
    {
        $lRow = array();
        $icon        = 'assets/images/icons/system/16x16/process.png';
        $lRow[]      = '<img src="' . $icon . '" width="16" height="16" title="payment" alt="payment"/>';
        // $lRow[]      = coreFunctions::formatDate($row['date_created'], SITE_CONFIG_DATE_TIME_FORMAT);
        // $lRow[]      = '<a href="user_manage.php?filterByAccountId='.urlencode($row['user_id']).'">'.adminFunctions::makeSafe($row['username']).'</a>';
        $lRow[]      = adminFunctions::makeSafe($row['name']);
        $lRow[]      = adminFunctions::makeSafe($row['payment_id']);
        $lRow[]      = adminFunctions::makeSafe($row['ammount']);
        $lRow[]      = adminFunctions::makeSafe($row['status']);
        $lRow[]      = adminFunctions::makeSafe($row['created_at']);

        $links = array();
        $links[] = '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="view" onClick="viewPaymentDetail(' . (int) $row['id'] . '); return false;"><span class="fa fa-info text-primary" aria-hidden="true"></span></a>';
        $lRow[] = '<div class="btn-group">'.implode(" ", $links).'</div>';

        $data[] = $lRow;
    }
}

$resultArr = array();
$resultArr["sEcho"]                = intval($_GET['sEcho']);
$resultArr["iTotalRecords"]        = (int) $totalRS;
$resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
$resultArr["aaData"]               = $data;

echo json_encode($resultArr);
