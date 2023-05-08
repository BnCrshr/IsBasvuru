<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }
}
