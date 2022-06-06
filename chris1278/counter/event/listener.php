<?php
/**
 *
 * Counter. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\counter\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $config;
	protected $user;
	protected $auth;
	protected $language;
	protected $template;

	public function __construct(
		\phpbb\config\config $config,
		\chris1278\counter\core\db_controller $counter_sql,
		\phpbb\user $user,
		\phpbb\auth\auth $auth,
		\phpbb\language\language $language,
		\phpbb\template\template $template
	)
	{
		$this->config			= $config;
		$this->counter_sql		= $counter_sql;
		$this->user				= $user;
		$this->auth 			= $auth;
		$this->language 		= $language;
		$this->template			= $template;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup'			=> 'load_language_on_setup',
			'core.permissions'			=> 'add_permissions',
			'core.page_header_after'	=> 'show_counter_on_index',
		];
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext	= $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'chris1278/counter',
			'lang_set'	=> 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function add_permissions($event)
	{
		$permissions = $event['permissions'];

		$permissions['u_view_counter'] = ['lang' => 'ACL_VIEW_COUNTER', 'cat' => 'misc'];

		$event['permissions'] = $permissions;
	}

	public function show_counter_on_index()
	{
		if ($this->auth->acl_get('u_view_counter'))
		{
			$text_counter_before		= [];
			$text_counter_after			= [];
			$text_counter_finish		= [];
			$text_counter_break_before	= [];
			$text_counter_break_after	= [];

			if ($this->config['counter_text'] == 1)
			{
				$transfer = [
					'var_lang_name'		=> 'count_before',
					'var_lang_value'	=> '',
					'var_lang_check'	=> $this->user->data['user_lang'],
					'var_lang_index'	=> '',
				];
				$this->counter_sql->connection_controller($transfer);

				$text_counter_before	= $this->counter_sql->value_core();

				if (!empty($text_counter_before))
				{
					$transfer = [
						'var_lang_name'		=> 'count_before',
						'var_lang_value'	=> '',
						'var_lang_check'	=> $this->user->data['user_lang'],
						'var_lang_index'	=> '',
					];
					$this->counter_sql->connection_controller($transfer);

					$text_counter_before		= $this->counter_sql->value_core();

					if ($this->config['counter_text_opt'] == 1)
					{
						$text_counter_break_before	= '<br>';
					}
					else
					{
						$text_counter_break_before	= ' ';
					}
				}
				else
				{
					$transfer = [
						'var_lang_name'		=> 'count_before',
						'var_lang_value'	=> '',
						'var_lang_check'	=> $this->config['default_lang'],
						'var_lang_index'	=> '',
					];
					$this->counter_sql->connection_controller($transfer);

					$text_counter_before		= $this->counter_sql->value_core();

					if ($this->config['counter_text_opt'] == 1)
					{
						$text_counter_break_before	= '<br>';
					}
					else
					{
						$text_counter_break_before	= ' ';
					}

					if (!$this->counter_sql->value_core())
					{
						$text_counter_before		= '';
						$text_counter_break_before	= '';
					}
				}

				$transfer = [
					'var_lang_name'		=> 'count_after',
					'var_lang_value'	=> '',
					'var_lang_check'	=> $this->user->data['user_lang'],
						'var_lang_index'	=> '',
				];
				$this->counter_sql->connection_controller($transfer);

				$text_counter_after	= $this->counter_sql->value_core();

				if (!empty($text_counter_after))
				{
					$transfer = [
						'var_lang_name'		=> 'count_after',
						'var_lang_value'	=> '',
						'var_lang_check'	=> $this->user->data['user_lang'],
						'var_lang_index'	=> '',
					];
					$this->counter_sql->connection_controller($transfer);

					$text_counter_after			= $this->counter_sql->value_core();

					if ($this->config['counter_text_opt'] == 1)
					{
						$text_counter_break_after	= '<br>';
					}
					else
					{
						$text_counter_break_after	= ' ';
					}
				}
				else
				{
					$transfer = [
						'var_lang_name'		=> 'count_after',
						'var_lang_value'	=> '',
						'var_lang_check'	=> $this->config['default_lang'],
						'var_lang_index'	=> '',
					];
					$this->counter_sql->connection_controller($transfer);

					$text_counter_after			= $this->counter_sql->value_core();

					if ($this->config['counter_text_opt'] == 1)
					{
						$text_counter_break_after	= '<br>';
					}
					else
					{
						$text_counter_break_after	= ' ';
					}

					if (!$this->counter_sql->value_core())
					{
						$text_counter_after			= '';
						$text_counter_break_after	= '';
					}
				}
			}
			else
			{
				$text_counter_before		= '';
				$text_counter_after			= '';
				$text_counter_break_before	= '';
				$text_counter_break_after	= '';
			}

			$transfer = [
				'var_lang_name'		=> 'count_finish',
				'var_lang_value'	=> '',
				'var_lang_check'	=> $this->user->data['user_lang'],
				'var_lang_index'	=> '',
			];
			$this->counter_sql->connection_controller($transfer);

			$text_counter_finish						= $this->counter_sql->value_core();

			if (!empty($text_counter_finish))
			{
				$transfer = [
					'var_lang_name'		=> 'count_finish',
					'var_lang_value'	=> '',
					'var_lang_check'	=> $this->user->data['user_lang'],
					'var_lang_index'	=> '',
				];
				$this->counter_sql->connection_controller($transfer);

				$text_counter_finish	= $this->counter_sql->value_core();
			}
			else
			{
				$transfer = [
					'var_lang_name'		=> 'count_finish',
					'var_lang_value'	=> '',
					'var_lang_check'	=> $this->config['default_lang'],
					'var_lang_index'	=> '',
				];
				$this->counter_sql->connection_controller($transfer);

				$text_counter_finish	= $this->counter_sql->value_core();

				if (!$this->counter_sql->value_core())
				{
					$text_counter_finish	= '';
				}
			}

			$counter_active								= $this->config['counter_active'];
			$counter_second								= $this->config['counter_second'];
			$counter_minute 							= $this->config['counter_minute'];
			$counter_hour								= $this->config['counter_hour'];
			$counter_day								= $this->config['counter_day'];
			$counter_month								= $this->config['counter_month'];
			$counter_year								= $this->config['counter_year'];
			$display_counter							= '<span id="Countdown"></span>';

			$this->template->assign_vars([
				'COUNTER_ACTIVE'						=> $counter_active,
				'COUNTER_BEFORE'						=> $text_counter_before,
				'COUNTER_AFTER'							=> $text_counter_after,
				'COUNTER_BREAK_BEFORE'					=> $text_counter_break_before,
				'COUNTER_BREAK_AFTER'					=> $text_counter_break_after,
				'COUNTER_FINISH'						=> $text_counter_finish,
				'COUNTER_SECOND'						=> $counter_second,
				'COUNTER_MINUTE'						=> $counter_minute,
				'COUNTER_HOUR'							=> $counter_hour,
				'COUNTER_DAY'							=> $counter_day,
				'COUNTER_MONTH'							=> $counter_month,
				'COUNTER_YEAR'							=> $counter_year,
				'DISPLAY_COUNTER'						=> $display_counter,
			]);
		}
	}
}
