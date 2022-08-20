<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $tenant, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $tenant, $password)
    {
        $this->tenant = $tenant;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.admin.tenant-activation');
    }
}
