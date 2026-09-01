<?php

namespace App\Mail;

use App\Models\FeeRequest;
use App\Models\FraudCase;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeeRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $feeRequest;
    public $case;
    public $user;

    public function __construct(FeeRequest $feeRequest, FraudCase $case, User $user)
    {
        $this->feeRequest = $feeRequest;
        $this->case = $case;
        $this->user = $user;
    }

    public function build()
    {
        $settings = Settings::find(1);

        return $this->markdown('emails.fee-request-created')
            ->subject('Fee Request for Case ' . $this->case->case_number)
            ->with(['settings' => $settings]);
    }
}
