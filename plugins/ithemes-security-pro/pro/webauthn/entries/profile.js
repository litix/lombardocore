/**
 * WordPress dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
import { setLocaleData } from '@wordpress/i18n';

// Silence warnings until JS i18n is stable.
setLocaleData( { '': {} }, 'ithemes-security-pro' );

/**
 * Internal dependencies
 */
import { PasswordlessLoginProfileFill } from '@ithemes/security.passwordless-login.profile';
import App from './profile/app.js';

registerPlugin( 'itsec-passwordless-login-profile', {
	scope: 'ithemes-security',
	render() {
		return (
			<PasswordlessLoginProfileFill>
				{ ( { user } ) => <App user={ user } /> }
			</PasswordlessLoginProfileFill>
		);
	},
} );
