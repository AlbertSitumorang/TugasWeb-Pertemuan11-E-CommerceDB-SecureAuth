<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalUsers'    => User::count(),
            'totalProducts' => Product::count(),
            'totalOrders'   => Order::count(),
            'omzet'         => Order::where('status', '!=', 'cancelled')->sum('total'),
            'byRole'        => [
                'admin'  => User::where('role', 'admin')->count(),
                'editor' => User::where('role', 'editor')->count(),
                'user'   => User::where('role', 'user')->count(),
            ],
        ]);
    }
}
