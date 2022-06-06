<?php
/**
 *
 * Counter. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\counter\core;

class db_controller
{
	protected $template;
	protected $db;
	protected $config;
	protected $language;
	protected $counter_table;

	public function __construct(
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\config\config $config,
		\phpbb\language\language $language,
		$counter_table
	)
	{
		$this->counter_table		= $counter_table;
		$this->template				= $template;
		$this->db					= $db;
		$this->config				= $config;
		$this->language				= $language;
	}

	public function display_counter_overview()
	{
		$sql = 'SELECT var_lang_value, var_lang_check, var_lang_name, var_lang_index
			FROM ' . $this->counter_table . '
			ORDER BY var_lang_check';
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		if (count($rows) > 0)
		{
			foreach ($rows as $row)
			{
				$this->send_to_var_local_name = $row['var_lang_check'];
				$var_local_name = $this->get_var_local_name();

				if ($row['var_lang_name'] == 'count_before')
				{
					if ($this->config['counter_text_opt'] == 1)
					{
						$row_var_lang_name = $this->language->lang('ACP_LANG_COUNT_ABOVE');
					}
					else
					{
						$row_var_lang_name = $this->language->lang('ACP_LANG_COUNT_BEFORE');
					}
				}
				else if ($row['var_lang_name'] == 'count_after')
				{
					if ($this->config['counter_text_opt'] == 1)
					{
						$row_var_lang_name = $this->language->lang('ACP_LANG_COUNT_BELOW');
					}
					else
					{
						$row_var_lang_name = $this->language->lang('ACP_LANG_COUNT_AFTER');
					}
				}
				else if ($row['var_lang_name'] == 'count_finish')
				{
					$row_var_lang_name = $this->language->lang('ACP_LANG_COUNT_FINISH');
				}

				$this->template->assign_block_vars('counter_lang_display', [
					'VAR_LANG_NAME'		=> $row_var_lang_name,
					'VAR_LANG_CHECK'	=> $var_local_name,
					'VAR_LANG_VALUE'	=> $row['var_lang_value'],
					'VAR_LANG_INDEX'	=> $row['var_lang_index'],
				]);
			}
		}
	}

	public function select_counter_lang()
	{
		$sql = 'SELECT lang_iso, lang_local_name
			FROM ' . LANG_TABLE . "
				ORDER BY lang_english_name";
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		if (count($rows) > 1)
		{
			foreach ($rows as $row)
			{
				$this->template->assign_block_vars('counter_lang_options', [
					'S_LANG_DEFAULT'	=> $row['lang_iso'] === $this->config['default_lang'],

					'LANG_ISO'			=> $row['lang_iso'],
					'LANG_LOCAL_NAME'	=> $row['lang_local_name'],
				]);
			}
		}
	}

	public function connection_controller($transfer)
	{
		$this->var_lang_name	= $transfer['var_lang_name'];
		$this->var_lang_value	= $transfer['var_lang_value'];
		$this->var_lang_check	= $transfer['var_lang_check'];
		$this->var_lang_index	= $transfer['var_lang_index'];
	}

	public function get_var_local_name()
	{
		$sql = 'SELECT  lang_local_name
			FROM ' . LANG_TABLE . '
				WHERE ' . $this->db->sql_in_set('lang_iso', $this->send_to_var_local_name);

		$sql		= $this->db->sql_query($sql);
		$answer_from_get_local_name	= $this->db->sql_fetchfield('lang_local_name');

		return $answer_from_get_local_name;
	}

	public function insert_lang_value()
	{
		$this->send_to_var_local_name = $this->var_lang_check;
		$var_lang_local_name = $this->get_var_local_name();

		$sql_insert = [
			'var_lang_name'			=> $this->var_lang_name,
			'var_lang_value'		=> $this->var_lang_value,
			'var_lang_check'		=> $this->var_lang_check,
			'var_lang_local_name'	=> $var_lang_local_name,
		];

		$this->db->sql_query('INSERT INTO ' . $this->counter_table . ' ' . $this->db->sql_build_array('INSERT', $sql_insert));
	}

	public function update_lang_value()
	{
		$sql_update = [
			'var_lang_value'		=> $this->var_lang_value,
		];

		$sql = 'UPDATE ' . $this->counter_table . '
			SET ' . $this->db->sql_build_array('UPDATE', $sql_update) . '
			WHERE ' . $this->db->sql_in_set('var_lang_check', $this->var_lang_check) . '
				AND ' . $this->db->sql_in_set('var_lang_name', $this->var_lang_name);
		$this->db->sql_query($sql);
	}

	public function value_core()
	{
		$sql = 'SELECT  var_lang_value
			FROM ' . $this->counter_table . '
				WHERE ' . $this->db->sql_in_set('var_lang_check', $this->var_lang_check) . '
				AND ' . $this->db->sql_in_set('var_lang_name', $this->var_lang_name);

		$sql		= $this->db->sql_query($sql);
		$select_value	= $this->db->sql_fetchfield('var_lang_value');

		return $select_value;
	}

	public function get_count_value()
	{
		$sql = 'SELECT  COUNT(var_lang_value) AS var_count_lang_value
			FROM ' . $this->counter_table . '
				WHERE ' . $this->db->sql_in_set('var_lang_check', $this->var_lang_check) . '
				AND ' . $this->db->sql_in_set('var_lang_name', $this->var_lang_name);

		$result		= $this->db->sql_query($sql);
		$select_count_value	= (int) $this->db->sql_fetchfield('var_count_lang_value');

		$this->db->sql_freeresult($result);

		return $select_count_value;
	}

	public function delete_lang_value()
	{
		$sql ='DELETE FROM ' . $this->counter_table . '
			WHERE ' . $this->db->sql_in_set('var_lang_index', $this->var_lang_index);

		$sql		= $this->db->sql_query($sql);
	}

	public function delete_lang_all()
	{
		$sql = 'DELETE
			FROM ' . $this->counter_table;

		$sql		= $this->db->sql_query($sql);
	}
}
