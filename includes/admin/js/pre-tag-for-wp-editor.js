var pre_tag_for_wp_editor;
( function( $ ) {
	pre_tag_for_wp_editor = {
		init: function() {

			// ------------------------------- adding pre tag to wp_editor ---------------------------------

			// Adding pre tag
			if ( typeof( QTags ) === 'function' ) {
				QTags.addButton( 'pre_tag_for_wp_editor', 'pre', pre_tag_for_wp_editor_callback, '', '', '', 52 );
			}
			
			// Encodes: &, <, >, ", '
			function htmlEntities( text ) {
				text = text || '';
				text = text.replace( /&([^#])(?![a-z1-4]{1,8};)/gi, '&#038;$1' );
				return text.replace( /</g, '&lt;' ).replace( />/g, '&gt;' ).replace( /"/g, '&quot;' ).replace( /'/g, '&#039;' );
			}

			function pre_tag_for_wp_editor_callback( element, canvas, ed ) {
				var t = this, startPos, endPos, cursorPos, scrollTop, v = canvas.value, l, r, i, sel, endTag = v ? t.tagEnd : '', event;
				
				var pretext = '', sel, startPos, endPos;
				if ( document.selection ) {
					canvas.focus();
					sel = document.selection.createRange();
					if ( sel.text.length > 0 ) {
						pretext = sel.text;
					}
				} else if ( canvas.selectionStart || canvas.selectionStart == '0' ) {
					startPos = canvas.selectionStart;
					endPos = canvas.selectionEnd;
					if ( startPos != endPos ) {
						pretext = canvas.value.substring(startPos, endPos);
					}
				}

				if ( pretext !== '' ) {
					pretext = htmlEntities(pretext);
					canvas.value = canvas.value.substr(0, canvas.selectionStart) + '<pre>' + pretext + '</pre>' + canvas.value.substr(canvas.selectionEnd, canvas.value.length);
				} else {
					alert( "Code not selected! \nPlease select the code/text that you inserted in the editor." );
				}
				
				if ( document.createEvent ) {
					event = document.createEvent( 'HTMLEvents' );
					event.initEvent( 'change', false, true );
					canvas.dispatchEvent( event );
				} else if ( canvas.fireEvent ) {
					canvas.fireEvent( 'onchange' );
				}

			};
		}
	};

	$( document ).ready( function( $ ) { pre_tag_for_wp_editor.init(); } );
} ) ( jQuery );