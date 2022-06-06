<?php
/**
 *
 * Counter. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\counter\controller;

/**
 * Counter ACP controller.
 */
class acp_controller
{
	protected $auth;
	protected $config;
	protected $language;
	protected $log;
	protected $request;
	protected $template;
	protected $user;
	protected $u_action;

	public function __construct(
		\chris1278\counter\core\db_controller $counter_sql,
		\phpbb\auth\auth $auth,
		\phpbb\config\config $config,
		\phpbb\language\language $language,
		\phpbb\log\log $log,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		\phpbb\user $user,
		$php_ext,
		$phpbb_root_path
	)
	{
		$this->counter_sql			= $counter_sql;
		$this->auth					= $auth;
		$this->phpbb_root_path		= $phpbb_root_path;
		$this->php_ext				= $php_ext;
		$this->config				= $config;
		$this->language				= $language;
		$this->log					= $log;
		$this->request				= $request;
		$this->template				= $template;
		$this->user					= $user;
	}

	public function display_options()
	{
		$this->language->add_lang('acp_common', 'chris1278/counter');
		add_form_key('chris1278_counter_acp');
		$user_perm			= $this->auth->acl_get('a_authusers');
		$group_perm			= $this->auth->acl_get('a_authgroups');
		$u_user_perm		= append_sid("{$this->phpbb_root_path}adm/index.$this->php_ext" ,'i=permissions&amp;mode=setting_user_global');
		$u_group_perm		= append_sid("{$this->phpbb_root_path}adm/index.$this->php_ext" ,'i=permissions&amp;mode=setting_group_global');

		$this->counter_sql->display_counter_overview();
		$this->counter_sql->select_counter_lang();

		if ($this->request->is_set_post('save_count_lang'))
		{
			$transfer = [
				'var_lang_name'			=> $this->request->variable('var_lang_name', ''),
				'var_lang_value'		=> $this->request->variable('var_lang_value', '', true),
				'var_lang_check'		=> $this->request->variable('var_lang_check', ''),
				'var_lang_index'		=> '',
			];
			$this->counter_sql->connection_controller($transfer);

			$count_value = $this->counter_sql->get_count_value();

			if ($count_value == 0)
			{
				$this->counter_sql->insert_lang_value();
				$this->page_refresh();
			}
			else
			{
				$this->counter_sql->update_lang_value();
				$this->page_refresh();
			}
		}

		if ($this->request->is_set_post('delete_counter_entry'))
		{
			$transfer = [
				'var_lang_name'			=> '',
				'var_lang_value'		=> '',
				'var_lang_check'		=> '',
				'var_lang_index'		=> $this->request->variable('delete_counter_entry', ''),
			];
			$this->counter_sql->connection_controller($transfer);

			$this->counter_sql->delete_lang_value();
			$this->page_refresh();

		}

		if ($this->request->is_set_post('delete_counter_table'))
		{
			if (confirm_box(true))
			{
				$this->counter_sql->delete_lang_all();
				$this->page_refresh();
			}
			else
			{
				confirm_box(
					false,
					$this->language->lang('ACP_COUNTER_MSG_CONFIRM_DELETE_ALL'),
					build_hidden_fields([
						'delete_counter_table' => true,
						'counter_confirm_box' => true,
						'u_action' => $this->u_action
					]),
					'@chris1278_counter/acp_counter_confirm_body.html'
				);
			}
		}

		if ($this->request->is_set_post('site_refresh'))
		{
			$this->page_refresh();
		}

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('chris1278_counter_acp'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
				$this->config->set('counter_active', $this->request->variable('counter_active', 0));
				$this->config->set('counter_text', $this->request->variable('counter_text', 0));
				$this->config->set('counter_text_opt', $this->request->variable('counter_text_opt', 0));
				$this->config->set('counter_second', $this->request->variable('counter_second', ''));
				$this->config->set('counter_minute', $this->request->variable('counter_minute', ''));
				$this->config->set('counter_hour', $this->request->variable('counter_hour', ''));
				$this->config->set('counter_day', $this->request->variable('counter_day', ''));
				$this->config->set('counter_month', $this->request->variable('counter_month', ''));
				$this->config->set('counter_year', $this->request->variable('counter_year', ''));
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_COUNTER_SETTINGS');
				trigger_error($this->language->lang('ACP_COUNTER_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		if ($user_perm && $group_perm)
		{
			$acp_permission_info = sprintf($this->language->lang('ACP_COUNTER_PERMISSION_INFO_BOTH'), $u_user_perm, $u_group_perm);
		}
		else if ($user_perm)
		{
			$acp_permission_info = sprintf($this->language->lang('ACP_COUNTER_PERMISSION_INFO_USER'), $u_user_perm);
		}
		else if ($group_perm)
		{
			$acp_permission_info = sprintf($this->language->lang('ACP_COUNTER_PERMISSION_INFO_GROUP'), $u_group_perm);
		}
		else
		{
			$acp_permission_info = false;
		}

		if ($this->config['counter_text_opt'] == 1)
		{
			$counter_text_above_before 	= $this->language->lang('ACP_LANG_COUNT_ABOVE');
			$counter_text_below_after 	= $this->language->lang('ACP_LANG_COUNT_BELOW');
		}
		else
		{
			$counter_text_above_before	= $this->language->lang('ACP_LANG_COUNT_BEFORE');
			$counter_text_below_after	= $this->language->lang('ACP_LANG_COUNT_AFTER');
		}

		$this->template->assign_vars([
			'U_ACTION'								=> $this->u_action,
			'COUNTER_ACTIVE'						=> $this->config['counter_active'],
			'COUNTER_TEXT'							=> $this->config['counter_text'],
			'COUNTER_TEXT_OPT'						=> $this->config['counter_text_opt'],
			'COUNTER_TEXT_OPT_ABOVE_BEFORE'			=> $counter_text_above_before,
			'COUNTER_TEXT_OPT_BELOW_AFTER'			=> $counter_text_below_after,
			'COUNTER_BEFORE'						=> $this->config['counter_before'],
			'COUNTER_AFTER'							=> $this->config['counter_after'],
			'COUNTER_FINISH'						=> $this->config['counter_finish'],
			'COUNTER_SECOND'						=> $this->config['counter_second'],
			'COUNTER_MINUTE'						=> $this->config['counter_minute'],
			'COUNTER_HOUR'							=> $this->config['counter_hour'],
			'COUNTER_DAY'							=> $this->config['counter_day'],
			'COUNTER_MONTH'							=> $this->config['counter_month'],
			'COUNTER_YEAR'							=> $this->config['counter_year'],
			'COUNTER_FIX_YEAR'						=> date("Y"),
			'COUNTER_PERM_INFO'						=> $acp_permission_info,
		]);
	}

	public function page_refresh()
	{
		header("Refresh:  0");
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
