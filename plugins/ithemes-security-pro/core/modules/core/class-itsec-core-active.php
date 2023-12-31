<?php

class ITSEC_Core_Active {

	/** @var string[] */
	private $handles = [];

	public function run() {
		add_action( 'rest_api_init', array( $this, 'rest_api_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 0 );
		add_action( 'login_enqueue_scripts', array( $this, 'register_scripts' ), 0 );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ), 0 );
		add_action( 'wp_footer', array( $this, 'add_live_reload' ), 1000 );
		add_action( 'admin_footer', array( $this, 'add_live_reload' ), 1000 );
	}

	public function rest_api_init() {
		$factory = ITSEC_Modules::get_container()->get( \iThemesSecurity\Actor\Multi_Actor_Factory::class );
		( new ITSEC_REST_Actor_Types_Controller( $factory ) )->register_routes();
		( new ITSEC_REST_Actors_Controller( $factory ) )->register_routes();
	}

	public function register_scripts() {
		$dir          = ITSEC_Core::get_plugin_dir() . 'dist/';
		$script_debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;

		if ( $script_debug && file_exists( $dir . 'manifest-dev.php' ) ) {
			$manifest = require $dir . 'manifest-dev.php';
		} else {
			$manifest = require $dir . 'manifest.php';
		}

		$handles_with_package_dependencies = [];

		foreach ( $manifest as $name => $config ) {
			if ( ! $config['files'] ) {
				continue;
			}

			$has_css = false;

			foreach ( $config['files'] as $file ) {
				$handle          = $this->name_to_handle( $name );
				$this->handles[] = $handle;

				if ( ! ITSEC_Core::is_pro() ) {
					// WordPress.org installs always use non-minified file names.
					// This is to allow for WP-CLI to scan the files since, by default
					// minified JS files are excluded.
					$path     = 'dist/' . $file;
					$is_debug = false;
				} elseif ( $script_debug && file_exists( $dir . $file ) ) {
					$path     = 'dist/' . $file;
					$is_debug = true;
				} else {
					if ( strpos( $file, '.min.' ) === false ) {
						$file = str_replace( '.', '.min.', $file );
					}

					$path     = 'dist/' . $file;
					$is_debug = false;
				}

				$is_css = ITSEC_Lib::str_ends_with( $file, '.css' );
				$is_js  = ! $is_css;

				if ( $is_css ) {
					$has_css = true;
				}

				if ( $is_debug ) {
					$version = filemtime( $dir . $file );
				} elseif ( $is_js && isset( $config['contentHash']['javascript'] ) ) {
					$version = $config['contentHash']['javascript'];
				} elseif ( $is_css && isset( $config['contentHash']['css/mini-extract'] ) ) {
					$version = $config['contentHash']['css/mini-extract'];
				} else {
					$version = $config['hash'];
				}

				$deps = $is_js ? $config['dependencies'] : [];

				foreach ( $deps as $i => $dep ) {
					if ( ! ITSEC_Lib::str_starts_with( $dep, '@ithemes/security.' ) ) {
						continue;
					}


					$parts      = explode( '.', $dep );
					$dep_handle = $this->name_to_handle( "{$parts[1]}/{$parts[2]}" );

					$deps[ $i ] = $dep_handle;

					$handles_with_package_dependencies[ $handle ][] = $dep_handle;
				}

				if ( $is_js && 'runtime' !== $name ) {
					$deps[] = $this->name_to_handle( 'runtime' );
				}

				if ( $is_css && in_array( 'wp-components', $config['dependencies'], true ) ) {
					$deps[] = 'wp-components';
				}

				foreach ( array_reverse( $config['vendors'] ) as $vendor ) {
					if ( ! isset( $manifest[ $vendor ] ) || $name === $vendor ) {
						continue;
					}

					if ( $is_js && $this->has_js( $manifest[ $vendor ]['files'] ) ) {
						$deps[] = $this->name_to_handle( $vendor );
					} elseif ( $is_css && $this->has_css( $manifest[ $vendor ]['files'] ) ) {
						$deps[] = $this->name_to_handle( $vendor );
					}
				}

				if ( $is_css ) {
					wp_register_style(
						$handle,
						plugins_url( $path, ITSEC_Core::get_plugin_file() ),
						$deps,
						$version
					);
				} else {
					wp_register_script(
						$handle,
						plugins_url( $path, ITSEC_Core::get_plugin_file() ),
						$deps,
						$version
					);
				}

				if ( in_array( 'wp-i18n', $deps, true ) ) {
					wp_set_script_translations( $handle, 'LION', '' );
				}

				if ( $is_js && ! empty( $config['runtime'] ) ) {
					$public_path = esc_js( trailingslashit( plugins_url( 'dist', ITSEC_Core::get_plugin_file() ) ) );
					wp_add_inline_script( $handle, "window.itsecWebpackPublicPath = window.itsecWebpackPublicPath || '{$public_path}';", 'before' );
				}
			}

			if ( ! $has_css && in_array( 'wp-components', $config['dependencies'], true ) ) {
				wp_register_style(
					$this->name_to_handle( $name ),
					'',
					[ 'wp-components' ]
				);
			}
		}

		foreach ( $handles_with_package_dependencies as $handle => $dependencies ) {
			if ( ! $asset = wp_styles()->registered[ $handle ] ?? null ) {
				continue;
			}

			foreach ( $dependencies as $dependency ) {
				if ( ! wp_style_is( $dependency, 'registered' ) ) {
					continue;
				}

				$asset->deps[] = $dependency;
			}
		}

		wp_add_inline_script( 'itsec-packages-data', sprintf(
			"wp.data.dispatch( 'ithemes-security/core' ).__unstableLoadInitialFeatureFlags( %s );",
			wp_json_encode( ITSEC_Lib_Feature_Flags::get_enabled() )
		) );
	}

	public function add_live_reload() {
		if ( ! ITSEC_Core::is_development() ) {
			return;
		}

		foreach ( $this->handles as $handle ) {
			if ( wp_script_is( $handle ) ) {
				$url = 'http://localhost:35729/livereload.js';

				if ( is_ssl() ) {
					$url = set_url_scheme( $url, 'https' );
				}

				echo '<script src="' . esc_url( $url ) . '" async></script>';

				return;
			}
		}
	}

	private function has_js( $files ) {
		foreach ( $files as $file ) {
			if ( ITSEC_Lib::str_ends_with( $file, '.js' ) ) {
				return true;
			}
		}

		return false;
	}

	private function has_css( $files ) {
		foreach ( $files as $file ) {
			if ( ITSEC_Lib::str_ends_with( $file, '.css' ) ) {
				return true;
			}
		}

		return false;
	}

	private function name_to_handle( $name ) {
		$name = str_replace( '/dist/', '/entry/', $name );

		return 'itsec-' . str_replace( '/', '-', $name );
	}
}
