<?php
/**
 * Copyright (C) 2014-2023 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cannot jump here' );
}
?>

<div class="ai1wm-container">
	<div class="ai1wm-row">
		<div class="ai1wm-left">
			<div class="ai1wm-holder" id="ai1wmve-schedule-event-form-component">
				<h1 class="ai1wmve-schedule-title">
					<i class="ai1wm-icon-calendar"></i>
					<?php _e( 'Create Event', AI1WM_PLUGIN_NAME ); ?>
				</h1>

				<schedule-event inline-template :event='<?php echo $event->to_json(); ?>' :advanced-options='<?php echo json_encode( $event->advanced_options() ); ?>'>
					<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ai1wm_schedule_event_save' ) ); ?>" id="ai1wmve-schedule-event-form" class="ai1wm-clear">
						<input type="hidden" name="event_id" v-model="form.event_id">
						<div class="ai1wm-event-fieldset">
							<h2><?php _e( 'Event info', AI1WM_PLUGIN_NAME ); ?></h2>
							<div class="ai1wm-event-row">
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-title"><?php _e( 'Title', AI1WM_PLUGIN_NAME ); ?></label>
									<input type="text" class="ai1wm-event-input" id="ai1wm-event-title" name="title" v-model="form.title" placeholder="<?php _e( 'Event title here', AI1WM_PLUGIN_NAME ); ?>" required/>
								</div>
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-type"><?php _e( 'Event type', AI1WM_PLUGIN_NAME ); ?></label>
									<select class="ai1wm-event-input" id="ai1wm-event-type" name="type" v-model="form.type" required>
										<option value="" disabled><?php _e( 'Select event type', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::TYPE_EXPORT ); ?>">
											<?php _e( 'Export', AI1WM_PLUGIN_NAME ); ?>
										</option>
									</select>
								</div>
							</div>

							<div class="ai1wm-event-row" v-if="advancedTypeOptions.length">
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-advanced-options"><?php _e( 'Advanced options', AI1WM_PLUGIN_NAME ); ?></label>
									<multiselect id="ai1wm-event-advanced-options" v-model="form.options" :options="advancedTypeOptions" multiple taggable :searchable="false">
										<template v-slot:tag="props">
											<span class="multiselect__tag">
												<span v-html="advancedOptionLocale(props.option)"></span>
												<i aria-hidden="true" tabindex="1" class="multiselect__tag-icon" @click="props.remove(props.option)"></i>
											</span>
										</template>
										<template v-slot:option="props">
											<span v-html="advancedOptionLocale(props.option)"></span>
										</template>
									</multiselect>
								</div>
							</div>
							<input name="options[]" v-for="option in form.options" type="hidden" :value="option" :key="'option_' +  option">

							<?php if ( defined( 'AI1WM_INCREMENTAL_PATH' ) ) : ?>
								<div class="ai1wm-event-row" v-if="form.type === '<?php echo Ai1wmve_Schedule_Event::TYPE_EXPORT; ?>'">
									<div class="ai1wm-event-field">
										<label class="ai1wm-event-label" for="ai1wm-event-incremental">
											<input type="checkbox" class="ai1wm-event-input" id="ai1wm-event-incremental" name="incremental" v-model="form.incremental"/>
											<?php _e( 'Incremental backup', AI1WM_PLUGIN_NAME ); ?>
										</label>
									</div>
								</div>
							<?php endif; ?>

							<div class="ai1wm-event-row" v-if="form.type === '<?php echo Ai1wmve_Schedule_Event::TYPE_EXPORT; ?>'">
								<div class="ai1wm-event-field ai1wm-encrypt-backups-container">
									<label class="ai1wm-event-label" for="ai1wm-event-password">
										<input type="checkbox" class="ai1wm-event-input" id="ai1wm-event-password" v-model="encrypted"/>
										<?php _e( 'Protect this backup with a password', AI1WM_PLUGIN_NAME ); ?>
									</label>
									<div class="ai1wm-encrypt-backups-passwords-toggle" v-if="encrypted">
										<div class="ai1wm-encrypt-backups-passwords-container">
											<toggle-password name="password" placeholder="<?php _e( 'Enter a password', AI1WM_PLUGIN_NAME ); ?>" class-name="ai1wm-event-input ai1wm-event-input-small" v-model="form.password"></toggle-password>
											<toggle-password name="password_confirmation" placeholder="<?php _e( 'Repeat the password', AI1WM_PLUGIN_NAME ); ?>" class-name="ai1wm-event-input ai1wm-event-input-small" v-model="password" :error="passwordConfirmed ? null : '<?php _e( 'The passwords do not match', AI1WM_PLUGIN_NAME ); ?>'"></toggle-password>
										</div>
									</div>
									<input type="hidden" name="password" value="" v-else />
								</div>
							</div>

							<div class="ai1wm-event-row" v-if="form.type === '<?php echo Ai1wmve_Schedule_Event::TYPE_EXPORT; ?>'">
								<div class="ai1wm-event-field ai1wm-event-field-row">
									<label for="ai1wmve-exclude_files">
										<input type="checkbox" id="ai1wmve-exclude_files" class="ai1wm-event-input" v-model="exclude_files"/>
										<?php _e( 'Do <strong>not</strong> include the selected files', AI1WM_PLUGIN_NAME ); ?>
									</label>
									<file-browser :value="this.excludedFiles"></file-browser>
								</div>
							</div>

							<div class="ai1wm-event-row" v-if="form.type === '<?php echo Ai1wmve_Schedule_Event::TYPE_EXPORT; ?>'">
								<div class="ai1wm-event-field ai1wm-event-field-row" id="ai1wmve-db-table-excluder">
									<label for="ai1wmve-exclude_db_tables" v-show="showDbExcluder">
										<input type="checkbox" id="ai1wmve-exclude_db_tables" class="ai1wm-event-input" v-model="exclude_db_tables"/>
										<?php _e( 'Do <strong>not</strong> include the selected database tables', AI1WM_PLUGIN_NAME ); ?>
									</label>
									<db-tables v-show="showDbExcluder" :value="this.excludedDbTables" :db-tables='<?php echo json_encode( $tables, JSON_HEX_APOS ); ?>'></db-tables>
								</div>
							</div>
						</div>

						<div class="ai1wm-event-fieldset" v-if="form.type">
							<h2><?php _e( 'Schedule', AI1WM_PLUGIN_NAME ); ?></h2>
							<div class="ai1wm-event-row">
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-schedule-interval"><?php _e( 'Interval', AI1WM_PLUGIN_NAME ); ?></label>
									<select class="ai1wm-event-input" id="ai1wm-event-schedule-interval" v-model="form.schedule.interval" name="schedule[interval]" required>
										<option value="" disabled><?php _e( 'Select interval', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::INTERVAL_HOURLY ); ?>" v-text="form.incremental ? '<?php _e( 'Continuous', AI1WM_PLUGIN_NAME ); ?>' : '<?php _e( 'Hourly', AI1WM_PLUGIN_NAME ); ?>'"></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::INTERVAL_DAILY ); ?>" v-text="form.incremental ? '<?php _e( 'Once per day', AI1WM_PLUGIN_NAME ); ?>' : '<?php _e( 'Daily', AI1WM_PLUGIN_NAME ); ?>'"><?php _e( 'Daily', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::INTERVAL_WEEKLY ); ?>" v-if="! form.incremental"><?php _e( 'Weekly', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::INTERVAL_MONTHLY ); ?>" v-if="! form.incremental"><?php _e( 'Monthly', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::INTERVAL_N_HOUR ); ?>" v-if="! form.incremental"><?php _e( 'N Hour', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::INTERVAL_N_DAYS ); ?>" v-if="! form.incremental"><?php _e( 'N Days', AI1WM_PLUGIN_NAME ); ?></option>
									</select>
								</div>

								<div class="ai1wm-event-field ai1wm-event-field-nested">
									<div class="ai1wm-event-field" v-if="form.schedule.interval === '<?php echo Ai1wmve_Schedule_Event::INTERVAL_WEEKLY; ?>'">
										<label class="ai1wm-event-label" for="ai1wm-event-schedule-weekday"><?php _e( 'Day', AI1WM_PLUGIN_NAME ); ?></label>
										<select class="ai1wm-event-input" id="ai1wm-event-schedule-weekday" v-model="form.schedule.weekday" name="schedule[weekday]" required>
											<option value="" disabled><?php _e( 'Day', AI1WM_PLUGIN_NAME ); ?></option>
											<option value="monday"><?php echo date_i18n( 'l', strtotime( 'monday' ) ); ?></option>
											<option value="tuesday"><?php echo date_i18n( 'l', strtotime( 'tuesday' ) ); ?></option>
											<option value="wednesday"><?php echo date_i18n( 'l', strtotime( 'wednesday' ) ); ?></option>
											<option value="thursday"><?php echo date_i18n( 'l', strtotime( 'thursday' ) ); ?></option>
											<option value="friday"><?php echo date_i18n( 'l', strtotime( 'friday' ) ); ?></option>
											<option value="saturday"><?php echo date_i18n( 'l', strtotime( 'saturday' ) ); ?></option>
											<option value="sunday"><?php echo date_i18n( 'l', strtotime( 'sunday' ) ); ?></option>
										</select>
									</div>

									<div class="ai1wm-event-field" v-else-if="form.schedule.interval === '<?php echo Ai1wmve_Schedule_Event::INTERVAL_MONTHLY; ?>'">
										<label class="ai1wm-event-label" for="ai1wm-event-schedule-day"><?php _e( 'Day', AI1WM_PLUGIN_NAME ); ?></label>
										<select class="ai1wm-event-input" id="ai1wm-event-schedule-day" v-model="form.schedule.day" name="schedule[day]" required>
											<option value="" disabled><?php _e( 'Day', AI1WM_PLUGIN_NAME ); ?></option>
											<?php foreach ( range( 1, 28 ) as $day ) : ?>
												<option value="<?php echo $day; ?>"><?php echo date_i18n( 'd', mktime( null, null, null, null, $day ) ); ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="ai1wm-event-field" v-if="form.schedule.interval === '<?php echo Ai1wmve_Schedule_Event::INTERVAL_N_HOUR; ?>' || form.schedule.interval === '<?php echo Ai1wmve_Schedule_Event::INTERVAL_N_DAYS; ?>'">
										<label class="ai1wm-event-label" for="ai1wm-event-schedule-n" v-text="form.schedule.interval === '<?php echo Ai1wmve_Schedule_Event::INTERVAL_N_HOUR; ?>' ? '<?php _e( 'N Hour', AI1WM_PLUGIN_NAME ); ?>' : '<?php _e( 'N Days', AI1WM_PLUGIN_NAME ); ?>'"></label>
										<input type="number" class="ai1wm-event-input" id="ai1wm-event-schedule-n" name="schedule[n]" v-model="form.schedule.n" :placeholder="form.schedule.interval === '<?php echo Ai1wmve_Schedule_Event::INTERVAL_N_HOUR; ?>' ? '<?php _e( 'Hours', AI1WM_PLUGIN_NAME ); ?>' : '<?php _e( 'Days', AI1WM_PLUGIN_NAME ); ?>'" required />
									</div>

									<div class="ai1wm-event-field" v-if="form.schedule.interval && form.schedule.interval !== '<?php echo Ai1wmve_Schedule_Event::INTERVAL_N_HOUR; ?>' && form.schedule.interval !== '<?php echo Ai1wmve_Schedule_Event::INTERVAL_HOURLY; ?>'">
										<label class="ai1wm-event-label" for="ai1wm-event-schedule-hour"><?php _e( 'Hour', AI1WM_PLUGIN_NAME ); ?></label>
										<select class="ai1wm-event-input" id="ai1wm-event-schedule-hour" v-model="form.schedule.hour" name="schedule[hour]" required>
											<option value="" disabled><?php _e( 'Hour', AI1WM_PLUGIN_NAME ); ?></option>
											<?php foreach ( range( 0, 23 ) as $hour ) : ?>
												<option value="<?php echo $hour; ?>"><?php echo date_i18n( 'g a', mktime( $hour ) ); ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="ai1wm-event-field" v-if="! form.incremental && form.schedule.interval">
										<label class="ai1wm-event-label" for="ai1wm-event-schedule-minute"><?php _e( 'Minute', AI1WM_PLUGIN_NAME ); ?></label>
										<select class="ai1wm-event-input" id="ai1wm-event-schedule-minute" v-model="form.schedule.minute" name="schedule[minute]" required>
											<option value="" disabled><?php _e( 'Minute', AI1WM_PLUGIN_NAME ); ?></option>
											<?php foreach ( range( 0, 59 ) as $minute ) : ?>
												<option value="<?php echo $minute; ?>"><?php echo date_i18n( 'i', mktime( null, $minute ) ); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<input type="hidden" name="schedule[minute]" v-else-if="form.incremental" v-model="form.schedule.minute">
								</div>
							</div>

							<div class="ai1wm-event-row" v-if="! form.incremental">
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label">
										<input type="checkbox" class="ai1wm-event-input" name="do-not-repeat" v-model="do_not_repeat"/>
										<?php _e( 'Do not repeat', AI1WM_PLUGIN_NAME ); ?>
									</label>
								</div>
							</div>
						</div>

						<div class="ai1wm-event-fieldset" v-if="form.type">
							<h2><?php _e( 'Notification', AI1WM_PLUGIN_NAME ); ?></h2>
							<div class="ai1wm-event-row">
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-notification-reminder"><?php _e( 'Reminder', AI1WM_PLUGIN_NAME ); ?></label>
									<select class="ai1wm-event-input" id="ai1wm-event-notification-reminder" v-model="form.notification.reminder" name="notification[reminder]" required>
										<option value="" disabled><?php _e( 'Select reminder', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::REMINDER_NONE ); ?>"><?php _e( 'No notification', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::REMINDER_SUCCESS ); ?>"><?php _e( 'Notify on success', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::REMINDER_FAILED ); ?>"><?php _e( 'Notify on failure', AI1WM_PLUGIN_NAME ); ?></option>
									</select>
								</div>
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-notification-status"><?php _e( 'Status', AI1WM_PLUGIN_NAME ); ?></label>
									<select class="ai1wm-event-input" id="ai1wm-event-notification-status" v-model="form.notification.status" name="notification[status]" :disabled="!form.notification.reminder || form.notification.reminder === '<?php echo esc_attr( Ai1wmve_Schedule_Event::REMINDER_NONE ); ?>'">
										<option value="" disabled><?php _e( 'Select status', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::STATUS_ENABLED ); ?>"><?php _e( 'Enabled', AI1WM_PLUGIN_NAME ); ?></option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::STATUS_DISABLED ); ?>"><?php _e( 'Disabled', AI1WM_PLUGIN_NAME ); ?></option>
									</select>
								</div>
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-notification-email"><?php _e( 'Email', AI1WM_PLUGIN_NAME ); ?></label>
									<input type="text" class="ai1wm-event-input" id="ai1wm-event-notification-email" v-model="form.notification.email" name="notification[email]" placeholder="<?php _e( 'Your email here', AI1WM_PLUGIN_NAME ); ?>" :disabled="!form.notification.reminder || form.notification.reminder === '<?php echo esc_attr( Ai1wmve_Schedule_Event::REMINDER_NONE ); ?>'" />
								</div>
							</div>
						</div>

						<div class="ai1wm-event-fieldset" v-if="form.type">
							<h2><?php _e( 'Status', AI1WM_PLUGIN_NAME ); ?></h2>
							<div class="ai1wm-event-row">
								<div class="ai1wm-event-field">
									<label class="ai1wm-event-label" for="ai1wm-event-status"><?php _e( 'Status', AI1WM_PLUGIN_NAME ); ?></label>
									<select class="ai1wm-event-input" id="ai1wm-event-status" name="status" v-model="form.status">
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::STATUS_ENABLED ); ?>">
											<?php _e( 'Enabled', AI1WM_PLUGIN_NAME ); ?>
										</option>
										<option value="<?php echo esc_attr( Ai1wmve_Schedule_Event::STATUS_DISABLED ); ?>">
											<?php _e( 'Disabled', AI1WM_PLUGIN_NAME ); ?>
										</option>
									</select>
								</div>
								<div class="ai1wm-event-field"></div>
							</div>
						</div>

						<div class="ai1wm-event-fieldset" style="display: flex; justify-content: flex-end;">
							<button class="ai1wm-button-green"><?php _e( 'Save', AI1WM_PLUGIN_NAME ); ?></button>
						</div>

					</form>
				</schedule-event>
			</div>

		</div>

		<?php include AI1WM_TEMPLATES_PATH . '/common/sidebar-right.php'; ?>

	</div>

</div>
