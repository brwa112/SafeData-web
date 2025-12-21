<?php

namespace App\Http\Controllers\Pages\Frontend;

use App\Models\Pages\Client;
use Illuminate\Http\Request;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;

use App\Models\Pages\SocialLink;
use App\Models\Pages\PhoneNumbers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Pages\MailInformation;

class HomeController extends Controller
{

    public function index()
    {
        $services = Service::query()->get();
        $clients = Client::query()->get();
        $products = Product::query()->get();
        $hosting = Hosting::query()->get();
        $links = SocialLink::first();
        $phone_numbers = PhoneNumbers::all();

        return inertia('Frontend/Home', [
            'clients' => $clients,
            'services' => $services,
            'products' => $products,
            'hosting' => $hosting,
            'links' => $links,
            'phone_numbers' => $phone_numbers,
        ]);
    }


    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $email = $request->email;
        $subject = $request->subject ?? 'No Subject';
        $messageContent = $request->message;
        // dd($messageContent);
        $mail_information = MailInformation::first();
    //    return  $mail_information;
        if ($mail_information) {
            config([
                'mail.mailers.smtp.host' => $mail_information->host,
                'mail.mailers.smtp.port' => $mail_information->port,
                'mail.mailers.smtp.encryption' => $mail_information->encryption,
                'mail.mailers.smtp.username' => $mail_information->username,
                'mail.mailers.smtp.password' => $mail_information->password,
                'mail.from.address' => $mail_information->from_address,
                'mail.from.name' => $mail_information->from_name,
            ]);
        }
        // $meessg = Mail::send([], [], function ($message) use ($email, $subject, $messageContent, $mail_information) {
        //     $message->to($mail_information->username)
        //         ->replyTo($email, $email)  // Shows client's email as name
        //         ->subject($subject . ' - from ' . $email)  // Shows email in subject
        //         ->html("
        //             <p><strong>From:</strong> {$email}</p>
        //             <p><strong>Subject:</strong> {$subject}</p>
        //             <p><strong>Message:</strong></p>
        //             <p>{$messageContent}</p>
        //         ");
        // });

        Mail::send([], [], function ($message) use ($email, $subject, $messageContent, $mail_information) {
            $message
                ->to($mail_information->username)  // Send to site admin
                ->replyTo($email, $email)  // Client can be replied to
                ->subject("Contact Form: {$subject}")  // Clear subject
                ->html("
                                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                                    <div style='background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>
                                        <h2 style='margin: 0; color: #333;'>New Contact Form Submission</h2>
                                    </div>

                                    <div style='background-color: white; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px;'>
                                        <p style='margin: 10px 0;'><strong style='color: #555;'>From:</strong> {$email}</p>
                                        <p style='margin: 10px 0;'><strong style='color: #555;'>Subject:</strong> {$subject}</p>
                                        <hr style='border: 0; border-top: 1px solid #dee2e6; margin: 20px 0;'>
                                        <p style='margin: 10px 0;'><strong style='color: #555;'>Message:</strong></p>
                                        <div style='padding: 15px; background-color: #f8f9fa; border-radius: 5px;'>
                                            <p style='margin: 0; white-space: pre-wrap;'>" . nl2br(htmlspecialchars($messageContent)) . "</p>
                                        </div>
                                    </div>

                                    <div style='margin-top: 20px; padding: 15px; background-color: #e7f3ff; border-radius: 5px;'>
                                        <p style='margin: 0; font-size: 14px; color: #666;'>
                                            <strong>Note:</strong> Click 'Reply' to respond directly to {$email}
                                        </p>
                                    </div>
                                </div>
                            ");
        });
        // dd($meessg);
        return back()->with('success', 'Message sent successfully!');
    }
}
