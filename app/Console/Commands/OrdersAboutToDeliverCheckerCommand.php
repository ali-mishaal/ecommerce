<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Modules\OrderModule\Entities\Order;
use Modules\OrderModule\Notifications\OrderAboutToDeliverNotification;
use Modules\UserModule\Entities\Supervisor;
use Modules\UserModule\Entities\User;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class OrdersAboutToDeliverCheckerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:check_delivery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command checks if there is an order about to deliver without
    being assigned to driver and make an notification with order.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::where([
            ['driver_approved', false],
        ])
            ->whereBetween('delivery_time', [
                Carbon::now(),
                Carbon::now()->addDays(3)
            ])->get();

        $users = User::where('user_type', Supervisor::class)->get();

        foreach ($orders as $order)
        {
            Notification::send($users, new OrderAboutToDeliverNotification($order->id, $order->delivery_time));
        }

        info('done');

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
