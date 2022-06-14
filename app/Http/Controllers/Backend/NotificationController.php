<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    // ajax request function
    public function markNotification(Request $request){
        auth()->guard('admin')->user()
        ->unreadNotifications // get unread notification of current admin
        ->when($request->id,function($query) use ($request){ // if the request has id (if the request dosn't have id this function will not be executed and all unread notification will be marked as read)
            return $query->where('id',$request->id); // return the query with the specific id
        })->markAsRead(); // mark as read 
        // DB::table('notifications')
        //     ->where('id', $request->id)
        //     ->update(['read_at' => Carbon::now()]);
        return response()->noContent();
    }
}
