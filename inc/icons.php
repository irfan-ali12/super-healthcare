<?php
/**
 * Inline SVG icons keyed for service features and activity lists.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string, string> Raw SVG markup (no outer wrapper).
 */
function shc_get_icons() {
	return array(
		'personal-care'        => '<svg viewBox="0 0 32 32"><path d="M8 13h16M16 5v4M12 13v-2a4 4 0 0 1 8 0v2M11 18v2M16 18v3M21 18v2M13.5 24v2M18.5 24v2"/></svg>',
		'medication'           => '<svg viewBox="0 0 32 32"><rect x="6" y="12" width="20" height="9" rx="4.5" transform="rotate(-45 16 16.5)"/><path d="M12.8 13.3l6.4 6.4"/></svg>',
		'meals'                => '<svg viewBox="0 0 32 32"><path d="M6 17h20a10 10 0 0 1-20 0zM12 12c0-2 2-2 2-4M16 12c0-2 2-2 2-4M20 12c0-2 2-2 2-4"/></svg>',
		'household'            => '<svg viewBox="0 0 32 32"><path d="M5 15l11-9 11 9M8 13v13h16V13M13 26v-7h6v7"/></svg>',
		'shopping'             => '<svg viewBox="0 0 32 32"><path d="M5 7h3l3 13h13l2-9H10"/><circle cx="13" cy="25" r="1.6"/><circle cx="22" cy="25" r="1.6"/></svg>',
		'companionship'        => '<svg viewBox="0 0 32 32"><circle cx="11" cy="11" r="3.5"/><circle cx="21" cy="11" r="3.5"/><path d="M4 25c0-4 3-7 7-7s7 3 7 7M14 25c0-4 3-7 7-7s7 3 7 7"/></svg>',
		'family-communication' => '<svg viewBox="0 0 32 32"><path d="M6 8h20v13H14l-6 5v-5H6z"/><path d="M11 13h10M11 17h6"/></svg>',
		'hobbies-community'    => '<svg viewBox="0 0 32 32"><path d="M16 27V15M16 15c0-5 4-9 10-9 0 6-4 9-10 9zM16 19c0-4-3-7-8-7 0 5 3 7 8 7z"/></svg>',
	);
}

/**
 * Echo a feature icon by key.
 *
 * @param string $key Icon key.
 */
function shc_icon( $key ) {
	$icons = shc_get_icons();
	if ( isset( $icons[ $key ] ) ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- inline SVG from theme.
		echo $icons[ $key ];
	}
}
