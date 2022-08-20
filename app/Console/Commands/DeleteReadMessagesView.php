<?php

namespace App\Console\Commands;

use App\Models\UserChatView;
use Illuminate\Console\Command;

class DeleteReadMessagesView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat-counter:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete viewed chat messages counter.';

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
     * @return int
     */
    public function handle()
    {
        $chat = UserChatView::where('read_at', '!=', NULL)->delete();
    }
}
