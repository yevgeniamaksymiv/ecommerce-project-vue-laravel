<?php

namespace App\Jobs;

use App\Models\Order;
use Dompdf\Image\Cache;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;

class CreateOrderPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('email.test', ['order' => $this->order]);
        $pdfContent = $pdf->output();
        Storage::put("orders/order_pdf_{$this->order->id}.pdf", $pdfContent);

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
            ]
        );
        $pusher->trigger(
            'order_pdf',
            'pdf-created',
            ['pdf_url' => $this->order->getPdfPath]
        );
    }
}
