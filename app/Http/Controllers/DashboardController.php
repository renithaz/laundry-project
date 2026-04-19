<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransOrder;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransactions = TransOrder::count();
        $totalRevenue = TransOrder::sum('total');
        $totalCustomers = Customer::count();
        
        $processOrders = TransOrder::where('order_status', 0)->count();
        $completedOrders = TransOrder::where('order_status', 1)->count();
        
        $recentTransactions = TransOrder::with('customer')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('dashboard.index', compact(
            'totalTransactions', 
            'totalRevenue', 
            'totalCustomers', 
            'processOrders', 
            'completedOrders',
            'recentTransactions'
        ));
    }
}
