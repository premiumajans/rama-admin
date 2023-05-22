<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        check_permission('mail index');
        $mails = Mail::all();
        return view('backend.mail.index', get_defined_vars());
    }

    public function delete(string $id)
    {
        check_permission('mail delete');
        return CRUDHelper::remove_item('\App\Models\Mail', $id);
    }
}
