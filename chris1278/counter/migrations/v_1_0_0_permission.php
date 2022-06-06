<?php
/**
 *
 * Counter. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\counter\migrations;

class v_1_0_0_permission extends \phpbb\db\migration\migration
{


	public static function depends_on()
	{
		return ['\chris1278\counter\migrations\v_1_0_0_acp_module'];
	}


	public function update_data()
	{
		return [
			['permission.add', ['u_view_counter', true, 'u_']],
		];
	}

	public function revert_schema()
	{
		return [
			['permission.remove', ['u_view_counter', true, 'u_']],
		];
	}
}
