<?php

namespace iThemesSecurity\WebAuthn;

use iThemesSecurity\Lib\Result;
use iThemesSecurity\WebAuthn\DTO\PublicKeyCredentialUserEntity;

interface PublicKeyCredentialUserEntity_Factory {

	/**
	 * Make a User Entity object for the requested WordPress user.
	 *
	 * @param \WP_User $user The WordPress user object.
	 *
	 * @return Result<PublicKeyCredentialUserEntity>
	 */
	public function make( \WP_User $user ): Result;
}
