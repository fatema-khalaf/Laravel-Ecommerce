<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DateTime;
class ReportController extends Controller
{
    // View all report page
    public function ReportView(){
        return view('backend.report.report_view');
    }

    // get orderes by date 
    public function ReportByDate(Request $request){
        // new idea format date
        $date = new DateTime($request->date); // get the date fron input tag
        $formatDate = $date->format('d F Y'); // reformat the date to match the date format in the database table
        $orders = Order::where('order_date' , $formatDate)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    }
    // get orders by month and year
    public function ReportByMonth(Request $request){
        $orders = Order::where('order_month' , $request->month)->where('order_year', $request->year_name)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    }
    // get orders by year
    public function ReportByYear(Request $request){
        $orders = Order::where('order_year', $request->year)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    }
}
