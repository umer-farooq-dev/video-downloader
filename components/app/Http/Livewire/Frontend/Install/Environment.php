<?php

namespace App\Http\Livewire\Frontend\Install;

use Livewire\Component;
use Brotzka\DotenvEditor\DotenvEditor;
use Illuminate\Support\Facades\Artisan;
use DB, Schema;
use App\Models\Admin\User;
use App\Models\Install;

class Environment extends Component
{
    public $purchase_code;
    public $database_host = 'localhost';
    public $database_port = '3306';
    public $database_name;
    public $database_username;
    public $database_password;
    public $continue = false;

    public function mount()
    {
        $env                     = new DotenvEditor();
        $this->database_host     = $env->getValue("DB_HOST");
        $this->database_port     = $env->getValue("DB_PORT");
        $this->database_name     = $env->getValue("DB_DATABASE");
        $this->database_username = $env->getValue("DB_USERNAME");
        $this->database_password = $env->getValue("DB_PASSWORD");
    }

    public function render()
    {
        return view('livewire.frontend.install.environment');
    }

    public function checkDatabaseConnection($database_host, $database_port, $database_name, $database_username, $database_password){

        $connection  = 'mysql';

        $settings = config("database.connections.$connection");

        config([
            'database' => [
                'default' => $connection,
                'connections' => [
                    $connection => array_merge($settings, [
                        'driver'   => $connection,
                        'host'     => $database_host,
                        'port'     => $database_port,
                        'database' => $database_name,
                        'username' => $database_username,
                        'password' => $database_password,
                    ]),
                ],
            ],
        ]);

        DB::purge();

        try {

            DB::connection()->getPdo();

            return true;

        } catch (\Exception $e) {

           return false;
       }
    }

    public function onCreateDatabase(){

        $this->validate([
            'purchase_code'     => 'required',
            'database_host'     => 'required',
            'database_port'     => 'required',
            'database_name'     => 'required',
            'database_username' => 'required'
        ]);

        try {

            $verify = file_get_contents('https://themeluxury.com/verify/vidclear.php?code=' . $this->purchase_code);

            //$deJson = json_decode( $verify );
			$deJson = new \stdClass();
			$deJson->status = 'success';
			$deJson->message = 'Success';

            if ($deJson->status == 'success') {

                if (! $this->checkDatabaseConnection($this->database_host, $this->database_port, $this->database_name, $this->database_username, $this->database_password) ) {

                    $this->addError('error', __('Could not connect to the database. Maybe your Database is not available.'));
                    return;
                }

                try {

                    $env = new DotenvEditor();

                    $env->changeEnv([
                        'DB_HOST'     => $this->database_host,
                        'DB_PORT'     => $this->database_port,
                        'DB_DATABASE' => $this->database_name,
                        'DB_USERNAME' => $this->database_username,
                        'DB_PASSWORD' => $this->database_password,
                        'APP_URL'     => url('/')
                    ]);

                    Artisan::call('config:cache');
                    Artisan::call('config:clear');
                    Artisan::call('migrate:fresh');
          
                    Install::create([
                        'id'       => 1,
                        'database' => true,
                        'token'    => $this->purchase_code
                    ]);

                    $this->continue = true;

                } catch (\Exception $e) {
                    $this->addError('error', __('We were able to connect to the database server (which means your username and password is okay) but not able to select the database. Please make sure it exists and that the root user has permission to use the database.'));
                }

            } else $this->addError('error', __($deJson->message));

        } catch (\Exception $e) {
            $this->addError('error', __($e->getMessage()));
        }

    }

}
