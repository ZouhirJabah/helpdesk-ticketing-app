<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;


class UpdateLateTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:update-late';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met à jour le statut des tickets en retard (plus de 48h)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updated = Ticket::where('created_at', '<', now()->subHours(48))
            ->whereNotIn('status', ['Solved', 'Late'])
            ->update(['status' => 'Late']);

        $this->info("$updated tickets ont été marqués comme 'Late' (En retard).");
    }
}
