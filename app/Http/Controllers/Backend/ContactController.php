<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacts = Contact::all();
        return view('backend.contact-us.index', get_defined_vars());
    }

    public function sendMessage(Request $request)
    {
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->read_status = 0;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->back()->with('successMessage', __('messages.send-success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', __('messages.error'));
        }
    }

    public function readContact($id)
    {
        abort_if(Gate::denies('contact index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $message = Contact::find($id);
        if ($message->read_status == 0) {
            $message->update(['read_status' => 1]);
        }
        activity()
            ->performedOn($message)
            ->event('read')
            ->causedBy(auth()->user())
            ->withProperties(['id' => $message->id, 'email' => $message->email, 'phone' => $message->phone, 'message' => $message->message])
            ->log('read');
        return view('backend.contact-us.read', get_defined_vars());
    }

    public function delContactUS($id)
    {
        abort_if(Gate::denies('contact-us delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Contact::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }
}
