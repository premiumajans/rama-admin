<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\MailList;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('newsletter index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subscribers = Newsletter::all();
        return view('backend.newsletter.index', get_defined_vars());
    }

    public function delNewsletter($id)
    {
        abort_if(Gate::denies('newsletter delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            Newsletter::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function newsletterHistory()
    {
        abort_if(Gate::denies('newsletter index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $mailLists = MailList::all();
        return view('backend.newsletter.history', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('newsletter create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.newsletter.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('newsletter create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subscribers = Newsletter::where('status', 1)->get();
        try {
        foreach ($subscribers as $subscriber) {
            $data = [
                'id' => $subscriber->id,
                'mail' => $subscriber->mail,
                'title' => $request->title,
                'content' => $request->cont,
            ];
            Mail::send('backend.mail.send', $data, function ($message) use ($subscriber, $data) {
                $message->to($subscriber->mail);
                $message->subject($data['title']);
            });
            MailList::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'content' => $request->cont,
                'sent_users' => $subscriber->mail,
            ]);
        }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.newsletter.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.newsletter.index');
        }
    }
}
