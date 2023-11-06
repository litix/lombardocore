/**
 * External dependencies
 */
import styled from '@emotion/styled';

/**
 * WordPress dependencies
 */
import { Button, Modal } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { createInterpolateElement, useState } from '@wordpress/element';
import { useSelect, useDispatch } from '@wordpress/data';

/**
 * iThemes dependencies
 */
import { TextSize } from '@ithemes/ui';

/**
 * Internal dependencies
 */
import { store, App as ManageCredentials, Credential, LearnMore } from '@ithemes/security.webauthn.manage';

const StyledModal = styled( Modal )`
	width: 25rem;
	max-width: 100%;
	margin: 5rem auto auto;

	.components-modal__content {
		padding: 0;
	  
		header {
			position: sticky;
			top: 0;
		}
	}
`;

const StyledDevicesHeader = styled.header`
	display: flex;
	align-items: center;
	gap: 1rem;
`;

const StyledCredentialList = styled.ul`
	list-style: none;
	display: flex;
	flex-wrap: wrap;
	gap: 1rem;
`;

const StyledCredential = styled( Credential )`
	width: 15rem;
`;

export default function App( { user } ) {
	const [ isOpen, setIsOpen ] = useState( false );
	const [ isRequested, setIsRequested ] = useState( false );
	const { credentials } = useSelect( ( select ) => ( {
		credentials: select( store ).getCredentials(),
	} ), [] );
	const { navigateTo } = useDispatch( store );

	if ( ! user.itsec_passwordless_login.available_methods.includes( 'webauthn' ) ) {
		return null;
	}

	const onOpen = () => {
		if ( credentials.length > 0 ) {
			navigateTo( 'manage-credentials' );
			setIsRequested( true );
		} else {
			navigateTo( 'add-credential' );
			setIsRequested( false );
		}
		setIsOpen( true );
	};

	return (
		<>
			<h3>{ __( 'Passkeys', 'it-l10n-ithemes-security-pro' ) }</h3>
			<p>
				{ createInterpolateElement(
					__( 'Passkeys <b>improve security</b> and <b>speed up the login process</b> by using authentication built into your device instead of passwords. This can mean biometrics like Face ID, Touch ID, or Windows Hello. If your device doesn’t have those capabilities, don’t worry, you can still use passkeys.', 'it-l10n-ithemes-security-pro' ),
					{
						b: <strong />,
					}
				) }
				{ ' ' }
				{ __( 'Advanced users can also use external security keys like a YubiKey or Titan Key.', 'it-l10n-ithemes-security-pro' ) }
			</p>
			<p>
				{ __( 'When authenticating with a passkey, your personal information never leaves your device. Hackers can’t leak passkeys or trick you into sharing them.', 'it-l10n-ithemes-security-pro' ) }
				{ ' ' }
				<LearnMore textSize={ TextSize.NORMAL } />
			</p>

			{ credentials.length === 0 && (
				<Button
					variant="secondary"
					aria-expanded={ isOpen }
					onClick={ onOpen }
					text={ __( 'Setup Passkeys', 'it-l10n-ithemes-security-pro' ) }
				/>
			) }

			{ credentials.length > 0 && (
				<>
					<StyledDevicesHeader>
						<h4>{ __( 'Registered Passkeys', 'it-l10n-ithemes-security-pro' ) }</h4>
						<Button
							variant="secondary"
							aria-expanded={ isOpen }
							onClick={ onOpen }
							text={ __( 'Manage Passkeys', 'it-l10n-ithemes-security-pro' ) }
						/>
					</StyledDevicesHeader>
					<StyledCredentialList>
						{ credentials.map( ( credential ) => (
							<StyledCredential key={ credential.id } credential={ credential } as="li" />
						) ) }
					</StyledCredentialList>
				</>
			) }

			{ isOpen && (
				<StyledModal
					onRequestClose={ () => setIsOpen( false ) }
					__experimentalHideHeader
					contentLabel={ __( 'Manage Passkeys', 'it-l10n-ithemes-security-pro' ) }
				>
					<ManageCredentials onExit={ () => setIsOpen( false ) } isRequested={ isRequested } />
				</StyledModal>
			) }
		</>
	);
}
