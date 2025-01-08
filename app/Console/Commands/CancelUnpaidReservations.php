<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;

class CancelUnpaidReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
 //   protected $signature = 'command:name';
    protected $signature = 'reservations:cancel-unpaid';
    protected $description = 'Annule les réservations non payées après la date limite';


    /**
     * The console command description.
     *
     * @var string
     */
  //  protected $description = 'Command description';

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
        $expiredReservations = Reservation::where('limit', '<', now())
            ->where('etat', 'attente') // Assurez-vous d’avoir un statut pour la réservation
            ->get();

        foreach ($expiredReservations as $reservation) {
            $reservation->update(['etat' => 'annulé']);
        }

        $this->info('Réservations non payées annulées avec succès.');
    }
}
