<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function manage(){
        // \Auth::user()->authorize('core_module_dashboard_manage');

        $data['activePage'] = ['dashboard' => 'dashboard'];
        $data['breadcrumb'] = [
            // ['title' => $this->title],
        ];
        $contact_us = \Modules\CMS\Entities\ContactUs::orderBy('id', 'DESC')->get();
        return view('dashboard' , [
            'data' => $data,
            'contact_us' => $contact_us
        ]);
    }
}
