$schedule->command('model:prune', [
    '--model' => [Address::class, Flight::class],
])->daily();
