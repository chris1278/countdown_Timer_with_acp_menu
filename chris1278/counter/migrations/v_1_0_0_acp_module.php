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

class v_1_0_0_acp_module extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v32x\v329'];
	}

	public function update_data()
	{
		return [
			['config.add', ['chris1278_counter_goodbye', 0]],

			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_COUNTER_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_COUNTER_TITLE',
				[
					'module_basename'	=> '\chris1278\counter\acp\main_module',
					'modes'				=> ['settings'],
				],
			]],
		];
	}
}
