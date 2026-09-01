<?php

namespace App\Mail;

use App\Models\FraudCase;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryCredit extends Mailable
{
    use Queueable, SerializesModels;

    public $case;
    public $user;
    public $amount;

    public function __construct(FraudCase $case, User $user, $amount)
    {
        $this->case = $case;
        $this->user = $user;
        $this->amount = $amount;
    }

    public function build()
    {
        $settings = Settings::find(1);

        return $this->markdown('emails.recovery-credit')
            ->subject('Funds Recovered - Case ' . $this->case->case_number)
            ->with(['settings' => $settings]);
    }
}
