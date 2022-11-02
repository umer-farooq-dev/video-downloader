<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Classes\SoundCloud;
use App\Classes\Vimeo;
use App\Classes\Twitter;
use App\Classes\VLive;
use App\Classes\TikTok;
use App\Classes\Facebook;
use App\Classes\Instagram;
use App\Classes\Youtube;

use App\Models\Admin\APIKeys;
use App\Models\Admin\Downloads;

use DateTime;
use Illuminate\Support\Facades\Auth;

class Pages extends Component
{
	public $email;
	public $password;
	public $remember_me;

	public $page;
	public $pageTrans;
	public $homeTitle;
	public $general;
	public $profile;
	public $menus;
	public $header;
	public $footer;
	public $notice;
	public $supported_sites;
	public $advanced;
	public $advertisement;
	public $api_key;
	public $socials;
	public $twitter;

	public $data = [];
	public $link;

    public function mount()
    {
		$page            = $this->page;
		$pageTrans       = $this->pageTrans;
		$homeTitle       = $this->homeTitle;
		$general         = $this->general;
		$profile         = $this->profile;
		$menus           = $this->menus;
		$header          = $this->header;
		$footer          = $this->footer;
		$notice          = $this->notice;
		$supported_sites = $this->supported_sites;
		$advanced        = $this->advanced;
		$advertisement   = $this->advertisement;
		$api_key         = $this->api_key;
		$socials         = $this->socials;
		$twitter         = $this->twitter;
    }

    public function render()
    {
        return view('livewire.frontend.pages');
    }

    public function onLogin()
    {
        $this->validate([
			'email'    => 'required|email',
			'password' => 'required'
        ]);

		if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {

		    return redirect()->route('dashboard');
		}
        else {
        	$this->addError('401', __('The Email or Password is Incorrect!'));
        }

    }

    public function onDownload()
    {
	    $host = parse_url($this->link, PHP_URL_HOST);

	    $domain = str_ireplace('www.', '', $host);

	    include app_path() . '/Classes/Functions.php';
	    
	    switch ( $domain ) {

	    	case 'soundcloud.com':
	    	case 'm.soundcloud.com':

					include app_path() . '/Classes/SoundCloud.php';

					$sc = new SoundCloud();

		            $this->data = $sc->download( $this->link );

	    		break;

	    	case 'vimeo.com':
	    	case 'player.vimeo.com':

					include app_path() . '/Classes/Vimeo.php';

					$vm = new Vimeo();

		            $this->data = $vm->download( $this->link );

	    		break;

	    	case 'twitter.com':
	    	case 'mobile.twitter.com':

					include app_path() . '/Classes/Twitter.php';

					$tw = new Twitter();

		            $this->data = $tw->download( $this->link );

	    		break;

	    	case 'vlive.tv':

					include app_path() . '/Classes/VLive.php';

					$vl = new VLive();

		            $this->data = $vl->download( $this->link );

	    		break;

	    	case 'tiktok.com':
	    	case 'm.tiktok.com':
	    	case 'vm.tiktok.com':
	    	case 'vt.tiktok.com':

					include app_path() . '/Classes/TikTok.php';

					$tt = new TikTok();

		            $this->data = $tt->download( $this->link );

	    		break;

	    	case 'facebook.com':
	    	case 'web.facebook.com':
	    	case 'm.facebook.com':
	    	case 'fb.watch':
	    	case 'fb.com':
	    	case 'fb.gg':

					include app_path() . '/Classes/Facebook.php';

					$fb = new Facebook();

		            $this->data = $fb->download( $this->link );

	    		break;

	    	case 'instagram.com':

					include app_path() . '/Classes/Instagram.php';

					$ig = new Instagram();

		            $this->data = $ig->download( $this->link );

	    		break;

	    	case 'youtube.com':
	    	case 'youtu.be':
	    	case 'm.youtube.com':   	
	    	
					include app_path() . '/Classes/Youtube.php';

					$yt = new Youtube();

		            $this->data = $yt->download( $this->link );

	    		break;

	    	default:
		            session()->flash('status', 'error');
		            session()->flash('message', __('The link you sent is not on the supported sites.'));
	    		break;
	    }

        if ( !empty($this->data) ) {

			$dl             = new Downloads;
			$dl->source     = $this->data['source'];
			$dl->thumbnail  = $this->data['thumbnail'];
			$dl->link       = $this->link;
			$dl->client_ip  = get_client_ip();
			$dl->created_at = new DateTime();
			$dl->save();
        }
        //

    }

}
