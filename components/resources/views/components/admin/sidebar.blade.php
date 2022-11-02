	<div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<title>{{ __('shop') }}</title>
							<g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g id="Rounded-Icons" transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
									<g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
										<g id="shop-" transform="translate(0.000000, 148.000000)">
											<path class="color-background" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z" id="Path" opacity="0.598981585"></path>
											<path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z" id="Path"></path>
										</g>
									</g>
								</g>
							</g>
						</svg>
					</div>
					<span class="nav-link-text ms-1">{{ __('Dashboard') }}</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{ Route::is('pages', 'create-page', 'page-translations', 'create-page-translations', 'edit-page-translations') ? 'active' : '' }}" href="{{ route('pages') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<svg width="12px" height="12px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<title>{{ __('document') }}</title>
							<g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
									<g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
										<g id="document" transform="translate(154.000000, 300.000000)">
											<path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
											<path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
										</g>
									</g>
								</g>
							</g>
						</svg>
					</div>
					<span class="nav-link-text ms-1">{{ __('Pages') }}</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{ Route::is('general', 'menu', 'header', 'footer', 'create-footer-translations', 'edit-footer-translations', 'api-keys', 'json', 'gdpr', 'advertisement', 'smtp', 'proxy', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'active' : '' }}" data-bs-toggle="collapse" href="#theme-settings" role="button" aria-expanded="{{ Route::is('general', 'menu', 'header', 'footer', 'api-keys', 'json', 'gdpr', 'advertisement', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'true' : 'false' }}" aria-controls="theme-settings">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<title>{{ __('settings') }}</title>
							<g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
									<g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
										<g id="settings" transform="translate(304.000000, 151.000000)">
											<polygon class="color-background" id="Path" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
											<path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" id="Path" opacity="0.596981957"></path>
											<path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z" id="Path"></path>
										</g>
									</g>
								</g>
							</g>
						</svg>
					</div>
					<span class="nav-link-text ms-1">{{ __('Settings') }}</span>
				</a>

				<ul class="collapse multi-collapse {{ Route::is('general', 'menu', 'header', 'footer', 'create-footer-translations', 'edit-footer-translations', 'api-keys', 'json', 'gdpr', 'advertisement', 'smtp', 'proxy', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'show' : '' }}" id="theme-settings">

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('general') ? 'active' : '' }}" href="{{ route('general') }}">
							<span class="nav-link-text ms-1">{{ __('General') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('menu') ? 'active' : '' }}" href="{{ route('menu') }}">
							<span class="nav-link-text ms-1">{{ __('Menu') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('header') ? 'active' : '' }}" href="{{ route('header') }}">
							<span class="nav-link-text ms-1">{{ __('Header') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('footer', 'create-footer-translations', 'edit-footer-translations') ? 'active' : '' }}" href="{{ route('footer') }}">
							<span class="nav-link-text ms-1">{{ __('Footer') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('api-keys') ? 'active' : '' }}" href="{{ route('api-keys') }}">
							<span class="nav-link-text ms-1">{{ __('API Keys') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('json') ? 'active' : '' }}" href="{{ route('json') }}">
							<span class="nav-link-text ms-1">{{ __('JSON API') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('gdpr') ? 'active' : '' }}" href="{{ route('gdpr') }}">
							<span class="nav-link-text ms-1">{{ __('GDPR') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('advertisement') ? 'active' : '' }}" href="{{ route('advertisement') }}">
							<span class="nav-link-text ms-1">{{ __('Advertisement') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('smtp') ? 'active' : '' }}" href="{{ route('smtp') }}">
							<span class="nav-link-text ms-1">{{ __('SMTP') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ Route::is('proxy') ? 'active' : '' }}" href="{{ route('proxy') }}">
							<span class="nav-link-text ms-1">{{ __('Proxy') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ ( Route::is('redirects') ) ? 'active' : '' }}" href="{{ route('redirects') }}">
							<span class="nav-link-text ms-1">{{ __('Redirects') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ ( Route::is('translations') || Route::is('edit-translations') ) ? 'active' : '' }}" href="{{ route('translations') }}">
							<span class="nav-link-text ms-1">{{ __('Translations') }}</span>
						</a>
					</li>

					<li class="nav-item ms-5">
						<a class="nav-link {{ ( Route::is('advanced') ) ? 'active' : '' }}" href="{{ route('advanced') }}">
							<span class="nav-link-text ms-1">{{ __('Advanced') }}</span>
						</a>
					</li>

				</ul>

			</li>

			<li class="nav-item">
				<a class="nav-link {{ Route::is('supported-sites') ? 'active' : '' }}" href="{{ route('supported-sites') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-th-list sidebar-icon"></i>
					</div>
					<span class="nav-link-text ms-1">{{ __('Supported Sites') }}</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{ Route::is('report') ? 'active' : '' }}" href="{{ route('report') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-link sidebar-icon"></i>
					</div>
					<span class="nav-link-text ms-1">{{ __('Report') }}</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{ Route::is('downloads') ? 'active' : '' }}" href="{{ route('downloads') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-download sidebar-icon"></i>
					</div>
					<span class="nav-link-text ms-1">{{ __('Latest Downloads') }}</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{ Route::is('cache') ? 'active' : '' }}" href="{{ route('cache') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-archive sidebar-icon"></i>
					</div>
					<span class="nav-link-text ms-1">{{ __('Cache') }}</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-info-circle sidebar-icon"></i>
					</div>
					<span class="nav-link-text ms-1">{{ __('About') }}</span>
				</a>
			</li>

		</ul>
	</div>