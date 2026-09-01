<?php

namespace App\Mail;

use App\Models\FraudCase;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CaseFiled extends Mailable
{
    use Queueable, SerializesModels;

    public $case;
    public $user;
    public $forAdmin;

    public function __construct(FraudCase $case, User $user, $forAdmin = false)
    {
        $this->case = $case;
        $this->user = $user;
        $this->forAdmin = $forAdmin;
    }

    public function build()
    {
        $settings = Settings::find(1);
        $subject = $this->forAdmin
            ? 'New Recovery Case Filed - ' . $this->case->case_number
            : 'Your Recovery Case Has Been Filed - ' . $this->case->case_number;

        return $this->markdown('emails.case-filed')
            ->subject($subject)
            ->with(['settings' => $settings]);
    }
}
