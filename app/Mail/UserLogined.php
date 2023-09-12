<?php
//
//namespace App\Mail;
//
//use App\Models\User;
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Mail\Mailable;
//use Illuminate\Mail\Mailables\Content;
//use Illuminate\Mail\Mailables\Envelope;
//use Illuminate\Queue\SerializesModels;
//
//class UserLogined extends Mailable
//{
//    use Queueable, SerializesModels;
//
//    public $user;
//    /**
//     * Create a new message instance.
//     */
//    public function __construct(User $user)
//    {
//        $this->user = $user;
//    }
//
//    /**
//     * Get the message envelope.
//     */
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'User Logined',
//        );
//    }
//
//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'mails.user-logined',
//        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }
//}
