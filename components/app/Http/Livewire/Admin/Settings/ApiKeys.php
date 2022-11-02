<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\APIKeys as APIKey;
use File;
class ApiKeys extends Component
{

	public $recaptcha_public_api_key;
	public $recaptcha_private_api_key;

	public $twitter_oauth_access_token;
	public $twitter_oauth_access_token_secret;
	public $twitter_consumer_key;
	public $twitter_consumer_secret;

	public $soundcloud_api_key;
	public $facebook_cookies;
	public $instagram_cookies;

    public function mount()
    {
		$api_key                                 = APIKey::findOrFail(1);
		$this->recaptcha_public_api_key          = $api_key->recaptcha_public_api_key;
		$this->recaptcha_private_api_key         = $api_key->recaptcha_private_api_key;

		$this->twitter_oauth_access_token        = $api_key->twitter_oauth_access_token;
		$this->twitter_oauth_access_token_secret = $api_key->twitter_oauth_access_token_secret;
		$this->twitter_consumer_key              = $api_key->twitter_consumer_key;
		$this->twitter_consumer_secret           = $api_key->twitter_consumer_secret;

		$this->facebook_cookies                  = $api_key->facebook_cookies;
		$this->instagram_cookies                 = $api_key->instagram_cookies;
    }

    public function render()
    {
        return view('livewire.admin.settings.api-keys');
    }

    public function onUpdateAPIKeys()
    {
    	try {

			$api_key                                    = APIKey::findOrFail(1);
			$api_key->recaptcha_public_api_key          = $this->recaptcha_public_api_key;
			$api_key->recaptcha_private_api_key         = $this->recaptcha_private_api_key;
			
			$api_key->twitter_oauth_access_token        = $this->twitter_oauth_access_token;
			$api_key->twitter_oauth_access_token_secret = $this->twitter_oauth_access_token_secret;
			$api_key->twitter_consumer_key              = $this->twitter_consumer_key;
			$api_key->twitter_consumer_secret           = $this->twitter_consumer_secret;

			$api_key->facebook_cookies                  = $this->facebook_cookies;
			$api_key->instagram_cookies                 = $this->instagram_cookies;
			
			//File::put( app_path() . ('/Classes/ig-cookie.txt'), $this->instagram_cookies );

			$api_key->updated_at                        = new DateTime();
			$api_key->save();
			
	        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

    	} catch (\Exception $e) {
    		$this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
    	}

    }

}
