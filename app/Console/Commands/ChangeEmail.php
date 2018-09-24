<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ChangeEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   protected $signature = 'user:email {email} {newemail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change your MinePoS email';
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
        $u = \App\User::where("email",$this->argument('email'))->get();
        if(sizeof($u) > 0){
            $u = $u[0];
            //$this->info($u->password);
            $u->email = $this->argument('newemail');
            $u->save();
            $this->info('Email Changed!');
        }else{
            $this->error('This email isnt linked to a MinePoS admin account!');
        }
    }
}
