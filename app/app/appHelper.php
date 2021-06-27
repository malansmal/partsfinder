<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
/**
 * Created by Md. Russel Hussain. <md.russel.hussain@gmail.com>
 * Date: 01-Apr-20
 * Time: 9:07 AM
 */

function getLoggedInUserFirstName(){
    if(isLogin())
        return Auth::user()->first_name;
    else return '';
}

function getLoggedInUserLastName(){
    if(isLogin())
        return Auth::user()->last_name;
    else return '';
}

function getLoggedInUserFullName(){
    if(isLogin())
        return Auth::user()->first_name.' '.Auth::user()->last_name;
    else return '';
}

function getLoggedInUserEmail(){
    if(isLogin())
        return Auth::user()->email;
    else return '';
}

function getLoggedInUserMobile(){
    if(isLogin()){
        $userId = getLoggedInUserId();
        $userDetails = \App\UsersDetails::userDetails($userId);

        return $userDetails->mobile;
    }
    else return '';
}

function getLoggedInUserId(){
    return Auth::user()->id;
}

function getLoggedInUserType(){
    return Auth::user()->user_type;
}

function isLogin(){
    if(Auth::guest())
        return false;
    else
        return true;
}

function getUserNameById($userId){
    return \App\User::getUserFullNameById($userId);
}

function getUserTypeById($userId){
    return \App\User::getUserTypeById($userId);
}

function getEmailById($userId){
    return \App\User::getEmailById($userId);
}

function AppDateFormat($dateTime){
    return empty($dateTime) ? '' : date('d M Y H:i A', strtotime($dateTime));
}

function getCurrentDateTime(){
    return date('Y-m-d H:i:s');
}

function getCurrentDate(){
    return date('Y-m-d');
}
function getDocDownloadLink($name){
    $path = public_path().'\documents\\'.$name;

    if(File::exists($path)){
        return URL::to("/documents/$name");
    }
    else return '#';
}

function getRandomString($length = 5)
{
    $pool = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}

function getQuoteNumber(){
    $now = new DateTime();

    $day = $now->format('d');
    $month = $now->format('m');
    $year = $now->format('y');
    $quoteNo = $year.$month.$day.rand(10,99);

    return $quoteNo;
}

function getPartImageLocation(){
    return public_path()."/part_images";
}

function getPercentage($total)
{
    if ( $total > 0 ) {
        return $total + round((($total * 25) / 100),2);
    } else {
        return 0;
    }
}

function sendHimMail($to, $name, $link, $subject, $blade, $requestNo, $orderNo){
    $data['name'] = $name;
    $data['email'] = $to;
    $data['subject'] = $subject;
    //dd($to, $name, $link, $subject, $blade, $data);
    try{
        Mail::send("e_mail.$blade",['name'=>$name, 'link'=>$link, 'requestNo'=>$requestNo, 'orderNo'=>$orderNo] , function ($message) use ($data)
        {
            $message->to($data['email'], $data['name'])->subject($data['subject']);
        });
    } catch (\Exception $e){dd($e);
        $resultMail = false;
    }

    return true;
}

function getApplicationLogo(){
    return asset('/images/logo.png');
}

function getApplicationName(){
    return 'PartsFinder';
}

function getSupplierContactNo($supplier){
    if(!empty($supplier->cellno))
        return $supplier->cellno;
    else if(!empty($supplier->telno))
        return $supplier->telno;
    else return '';
}

function getSupplierEmail($supplier){
    if(!empty($supplier->email))
        return $supplier->email;
    else if(!empty($supplier->email2))
        return $supplier->email2;
    else return '';
}

function getSupplierAddress($supplier){
    if(!empty($supplier->adr1))
        return $supplier->adr1;
    else if(!empty($supplier->adr2))
        return $supplier->adr2;
    else if(!empty($supplier->adr3))
        return $supplier->adr3;
    else if(!empty($supplier->adr4))
        return $supplier->adr4;
    else return '';
}

function getOrderNoByClaimId($claimId){
    $row = \App\Orders::getOrderNoByClaimId($claimId);

    return (!empty($row)) ? $row->buyer_order_no : '';
}

function getOrderReceivedDate($claimId){
    $row = \App\Orders::getOrderNoByClaimId($claimId);

    return (!empty($row)) ? AppDateFormat($row->received_date) : '';
}

function getUserName(){
    return Auth::user()->full_name;
}

function getUserType(){
    return Auth::user()->user_type;
}