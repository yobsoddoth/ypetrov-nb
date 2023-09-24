<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SimulateUsersEndpoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = <<<SIG
        simulate:users-endpoint
        {email? : user email}
        {firstName? : user first name}
        {lastName? : user last name}
        {--fake : use Faker to generate random user data}
    SIG;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post user data to the API endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = sprintf('%s:%s/users', env('APP_URL'), env('LARAVEL_PORT_NUMBER'));

        if ($this->option('fake')) {
            $faker = \Faker\Factory::create();
            $body = [
                'email' => $faker->email(),
                'firstName' => $faker->firstName(),
                'lastName' => $faker->lastName(),
            ];
        } else {
            $body = [
                'email' => $this->argument('email'),
                'firstName' => $this->argument('firstName'),
                'lastName' => $this->argument('lastName'),
            ];
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        $response = curl_exec($ch);

        if (empty($response)) {
            $this->error($response);
        } else if (curl_getinfo($ch, CURLINFO_RESPONSE_CODE) < 300) {
            $this->info('STATUS: ' . curl_getinfo($ch, CURLINFO_RESPONSE_CODE));
            $this->comment($response);
        } else {
            $this->error('STATUS: ' . curl_getinfo($ch, CURLINFO_RESPONSE_CODE));
            $this->comment($response);
        }

        curl_close($ch);
    }
}
