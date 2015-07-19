/**
 * Message object.
 *
 * This object is entitled to manage the display of messages.
 */
var THB_Message = {

	message_container: null,
	transition_delay: 3000,
	transition_speed: 180,
	
	/**
	 * Init
	 */
	init: function() {
		THB_Message.message_container = jQuery('#message-container');
	},

	/**
	 * Show
	 */
	show: function( text, type ) {
		THB_Message.init();

		var newMsg = jQuery('<li class="notice ' + type + '">' + text + '</li>');
		newMsg.css('display', 'none');

		THB_Message.message_container
			.append(newMsg);

		newMsg.appear(THB_Message.transition_speed, function() {
			newMsg
				.delay(THB_Message.transition_delay)
				.vanish(THB_Message.transition_speed);
		});
	},
	
	/**
	 * Hide
	 */
	hide: function() {
		THB_Message.init();

		var message = THB_Message.message_container.find('li');
		if( !message.hasClass('error') ) {
			message.delay(THB_Message.transition_delay).fadeOut(THB_Message.transition_speed);
		}
	}

}