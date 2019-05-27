<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function companyInfo()
    {
        $companyInfo = config('company');
        return $this->respond(true, $companyInfo);
    }

    public function editInfo() {

    }
}
