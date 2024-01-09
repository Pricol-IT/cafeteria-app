<?php 
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
// use Illuminate\Support\Carbon;

if (! function_exists('authUser')) {
    function authUser()
    {
        return auth()->user();
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/' . $path . '/'), $fileName);

        return "uploads/$path/" . $fileName;
    }
}

if (!function_exists('formatTime')) {
 
    function formatTime($date, $format = 'F d, Y H:i A')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('dayFormat')) {
    function dayFormat($date)
    {
        return Carbon::createFromFormat('Y-m-d',$date)->locale('en')->dayName;
    }

}

if (!function_exists('day1Format')) {
    function day1Format($date)
    {
        return Carbon::createFromFormat('d-m-Y',$date)->locale('en')->dayName;
    }

}

if (!function_exists('convertDateFormat')) {
    function convertDateFormat($date)
    {
        return date('d-m-Y', strtotime($date));
    }
}


if (!function_exists('convertWTDateFormat')) {
 
    function convertWTDateFormat($date, $format = 'F d, Y H:i A')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('convertWDateFormat')) {
 
    function convertWDateFormat($date)
    {
       return Carbon::createFromFormat('Y-m-d', $date)->format('d M Y');
    }
}



if (!function_exists('Shortname')) {
    function Shortname($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->locale('en')->shortDayName;
    }
}

if (! function_exists('userNotifications')) {
    function userNotifications()
    {
        return auth()->user()->notifications()->orderBy('id','desc')->take(6)->get();
    }
}

if (! function_exists('userNotificationsCount')) {

    function userNotificationsCount()
    {

        return auth()->user()->unreadNotifications()->count();
    }
}