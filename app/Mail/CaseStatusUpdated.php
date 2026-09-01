<?php

namespace App\Mail;

use App\Models\FraudCase;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CaseStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $case;
    public $user;
    public $oldStatus;

    public function __construct(FraudCase $case, User $user, $oldStatus)
    {
        $this->case = $case;
        $this->user = $user;
        $this->oldStatus = $oldStatus;
    }

    public function build()
    {
        $settings = Settings::find(1);

        return $this->markdown('emails.case-status-updated')
            ->subject('Case Update - ' . $this->case->case_number)
            ->with(['settings' => $settings]);
    }
}
