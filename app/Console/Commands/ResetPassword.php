<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:passwd {email} {passwd}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change your MinePoS password';

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
            $u->password = \Hash::make($this->argument('passwd'));
            $u->save();
            $this->info('Password Changed!');
        }else{
            $this->error('This email isnt linked to a MinePoS admin account!');
        }
    }
}
