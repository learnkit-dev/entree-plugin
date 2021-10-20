<?php

namespace LearnKit\Entree\Console;

use Illuminate\Console\Command;

class InstallEntree extends Command
{
    protected $name = 'entree:install';

    protected $description = 'Generates certificates';

    public function handle()
    {
        $sslCommand = 'openssl req -newkey rsa:2048 -new -x509 -days 3652 -nodes -out sp.crt -keyout sp.key';

        exec('cd ' . plugins_path('learnkit/entree/certs') . ' && ' . $sslCommand);

        $this->output->writeln('Certificates generated!');
    }
}