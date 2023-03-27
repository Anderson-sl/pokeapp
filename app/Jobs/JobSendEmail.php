<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $email;
    public $user;
    public function __construct($email)
    {
        $this->onQueue('email');
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->user = User::where('email', $this->email)->first();
            echo "-------------- START ------------------>\n";
            echo "Simulando envio de email para endereço {$this->email}\n";
            echo "Registrando usuário de email {$this->email}\n";
            if ($this->user) {
                //dump($this->user);
                $this->user->registed_at = now();
                $this->user->save();
                if ($this->user->registed_at) {
                    echo "Usuário de email {$this->email} registrado com sucesso\n";
                    echo "-------------- END ------------------>\n";
                    return;
                }
            }

            echo "Falha ao registrar usuário de email {$this->email}\n";
                echo "-------------- END ------------------>\n";
        } catch(\Exception $err) {
            dump($err);
        }
    }
}
