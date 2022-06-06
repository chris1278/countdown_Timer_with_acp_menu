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

class v_1_0_0_db extends \phpbb\db\migration\migration
{


	public static function depends_on()
	{
		return ['\chris1278\counter\migrations\v_1_0_0_permission'];
	}

	public function update_schema()
	{
		return [
			'add_tables' => [
				$this->table_prefix . 'chris1278_counter' => [
					'COLUMNS' => [
						'var_lang_index'			=> ['UINT', null, 'auto_increment'],
						'var_lang_name'				=> ['VCHAR:100'		, ''],
						'var_lang_value'			=> ['TEXT_UNI'		, ''],
						'var_lang_check'			=> ['VCHAR:30'		, ''],
						'var_lang_local_name'		=> ['VCHAR'			, ''],
					],
					'PRIMARY_KEY' => [
						'var_lang_index',
					],
				],
			],
		];
	}

	public function update_data()
	{
		$second = date("s");
		$minute = date("i");
		$hour	= date("H");
		$day	= date("d");
		$month	= date("m");
		$year 	= (date("Y")+1);

		return
		[
			['config.add', ['counter_active', 1]],
			['config.add', ['counter_text', 0]],
			['config.add', ['counter_text_opt', 1]],
			['config.add', ['counter_second', $second]],
			['config.add', ['counter_minute', $minute]],
			['config.add', ['counter_hour', $hour]],
			['config.add', ['counter_day', $day]],
			['config.add', ['counter_month', $month]],
			['config.add', ['counter_year', $year]],
			['custom', [[$this, 'import_counter_db']]],

		];
	}

	public function import_counter_db()
	{
		$sql_ary = [];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_before',
			'var_lang_value'		=> 'This is an example text (English)',
			'var_lang_check'		=> 'en',
			'var_lang_local_name'	=> 'English',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_after',
			'var_lang_value'		=> 'This is an example text (English)',
			'var_lang_check'		=> 'en',
			'var_lang_local_name'	=> 'English',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_finish',
			'var_lang_value'		=> 'This is an example text (English)',
			'var_lang_check'		=> 'en',
			'var_lang_local_name'	=> 'English',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_before',
			'var_lang_value'		=> 'Beispiel text (Deutsch Sie)',
			'var_lang_check'		=> 'de_x_sie',
			'var_lang_local_name'	=> 'Deutsch (Sie)',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_after',
			'var_lang_value'		=> 'Beispiel text (Deutsch Sie)',
			'var_lang_check'		=> 'de_x_sie',
			'var_lang_local_name'	=> 'Deutsch (Sie)',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_finish',
			'var_lang_value'		=> 'Beispiel text (Deutsch Sie)',
			'var_lang_check'		=> 'de_x_sie',
			'var_lang_local_name'	=> 'Deutsch (Sie)',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_before',
			'var_lang_value'		=> 'Beispiel text (Deutsch Du)',
			'var_lang_check'		=> 'de',
			'var_lang_local_name'	=> 'Deutsch (Du)',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_after',
			'var_lang_value'		=> 'Beispiel text (Deutsch Du)',
			'var_lang_check'		=> 'de',
			'var_lang_local_name'	=> 'Deutsch (Du)',
		];

		$sql_ary[] = [
			'var_lang_name'			=> 'count_finish',
			'var_lang_value'		=> 'Beispiel text (Deutsch Du)',
			'var_lang_check'		=> 'de',
			'var_lang_local_name'	=> 'Deutsch (Du)',
		];

		$this->db->sql_multi_insert($this->table_prefix . 'chris1278_counter' , $sql_ary);
	}

	public function revert_schema()
	{
		return [
			'drop_tables'	=> [$this->table_prefix . 'chris1278_counter'],
		];
	}
}
