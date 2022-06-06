<?php
/**
 *
 * Counter. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\counter\acp;

/**
 * Counter ACP module info.
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\chris1278\counter\acp\main_module',
			'title'		=> 'ACP_COUNTER_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_COUNTER',
					'auth'	=> 'ext_chris1278/counter',
					'cat'	=> ['ACP_COUNTER_TITLE'],
				],
			],
		];
	}
}
