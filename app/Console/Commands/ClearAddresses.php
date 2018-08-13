<?php

namespace App\Console\Commands;

use App\Address;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Cache;

class ClearAddresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addresses:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes unused addresses';

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
     * @return mixed
     */
    public function handle()
    {
        $used = User::pluck('address_id')->all();
        $addresses = Address::all()->whereNotIn('id', $used);

        $bar = $this->output->createProgressBar(count($addresses));

        foreach($addresses as $address){
            $address->delete();
            $bar->advance();
        }

        \Illuminate\Support\Facades\Cache::flush();

        $bar->finish();
    }
}
