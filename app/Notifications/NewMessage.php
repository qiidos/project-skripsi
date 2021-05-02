<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Pengguna;
use Illuminate\Support\Facades\Crypt;

class NewMessage extends Notification
{
    use Queueable;
    protected $nama;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nama)
    {
        $this->nama = $nama;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $pengguna = Pengguna::where('nama', $this->nama)->first();

        if ($pengguna != null) {
            $dekrip_token = Crypt::decryptString($pengguna->token);
            return (new MailMessage)
                ->subject('Email Verification SiTalang')
                ->greeting('Hello, ' . $pengguna->nama)
                ->line("Ini merupakan kode konfirmasi, silahkan masukkan kode berikut pada halaman yang telah ditentukan:")
                ->action($dekrip_token, url('#'))
                ->line('Terima kasih.');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
