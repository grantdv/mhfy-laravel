<?php

namespace App\Console\Commands;

use App\Models\OrderRequest;
use App\Services\OrderService;
use Illuminate\Console\Command;

class OrderInvoiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:invoice {order_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a Stripe payment link and emails it to the customer for a pending order.';

    /**
     * Execute the console command.
     *
     * @param  \Illuminate\Console\Input\InputInterface  $request
     * @param  \Illuminate\Console\Output\InputInterface  $output
     * @return int
     */
    public function handle(OrderService $orderService): int
    {
        $orderId = $this->argument('order_id');
        $order = OrderRequest::find($orderId);

        if (!$order) {
            $this->error("Order #{$orderId} not found.");
            return Command::FAILURE;
        }

        if ($order->status !== 'pending') {
            $this->error("Order #{$orderId} is not in 'pending' status.");
            return Command::FAILURE;
        }

        $this->info("Invoicing order #{$orderId}...");

        try {
            $orderService->invoiceOrder($order);
            $this->info("Order #{$orderId} has been successfully invoiced!");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to invoice order #{$orderId}: {$e->getMessage()}");
            return Command::FAILURE;
        }
    }
}
