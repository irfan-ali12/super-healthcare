<?php
/**
 * Inline SVG line icons (32px grid, stroke drawn by CSS).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string, string> Raw SVG markup.
 */
function shc_get_icons() {
	return array(
		'personal-care'        => '<svg viewBox="0 0 32 32"><path d="M8 13h16M16 5v4M12 13v-2a4 4 0 0 1 8 0v2M11 18v2M16 18v3M21 18v2M13.5 24v2M18.5 24v2"/></svg>',
		'medication'           => '<svg viewBox="0 0 32 32"><rect x="6" y="12" width="20" height="9" rx="4.5" transform="rotate(-45 16 16.5)"/><path d="M12.8 13.3l6.4 6.4"/></svg>',
		'meals'                => '<svg viewBox="0 0 32 32"><path d="M6 17h20a10 10 0 0 1-20 0zM12 12c0-2 2-2 2-4M16 12c0-2 2-2 2-4M20 12c0-2 2-2 2-4"/></svg>',
		'household'            => '<svg viewBox="0 0 32 32"><path d="M5 15l11-9 11 9M8 13v13h16V13M13 26v-7h6v7"/></svg>',
		'home'                 => '<svg viewBox="0 0 32 32"><path d="M5 15l11-9 11 9M8 13v13h16V13M13 26v-7h6v7"/></svg>',
		'shopping'             => '<svg viewBox="0 0 32 32"><path d="M5 7h3l3 13h13l2-9H10"/><circle cx="13" cy="25" r="1.6"/><circle cx="22" cy="25" r="1.6"/></svg>',
		'companionship'        => '<svg viewBox="0 0 32 32"><circle cx="11" cy="11" r="3.5"/><circle cx="21" cy="11" r="3.5"/><path d="M4 25c0-4 3-7 7-7s7 3 7 7M14 25c0-4 3-7 7-7s7 3 7 7"/></svg>',
		'family-communication' => '<svg viewBox="0 0 32 32"><path d="M6 8h20v13H14l-6 5v-5H6z"/><path d="M11 13h10M11 17h6"/></svg>',
		'hobbies-community'    => '<svg viewBox="0 0 32 32"><path d="M16 27V15M16 15c0-5 4-9 10-9 0 6-4 9-10 9zM16 19c0-4-3-7-8-7 0 5 3 7 8 7z"/></svg>',
		'shield'               => '<svg viewBox="0 0 32 32"><path d="M16 4l10 4v7c0 6.5-4.3 11.2-10 13-5.7-1.8-10-6.5-10-13V8z"/><path d="M11.5 16l3 3 6-6"/></svg>',
		'person'               => '<svg viewBox="0 0 32 32"><circle cx="16" cy="10" r="4.5"/><path d="M7 27c0-5 4-9 9-9s9 4 9 9"/></svg>',
		'heart'                => '<svg viewBox="0 0 32 32"><path d="M16 26s-10-6.2-10-13a5.5 5.5 0 0 1 10-3.2A5.5 5.5 0 0 1 26 13c0 6.8-10 13-10 13z"/></svg>',
		'vetted'               => '<svg viewBox="0 0 32 32"><rect x="7" y="5" width="18" height="23" rx="2"/><path d="M12 5v3h8V5M11.5 17l3 3 6-6"/></svg>',
		'phone'                => '<svg viewBox="0 0 32 32"><path d="M9 6h4l2 6-3 2a14 14 0 0 0 6 6l2-3 6 2v4a2 2 0 0 1-2 2C14 25 7 18 7 8a2 2 0 0 1 2-2z"/></svg>',
		'referral'             => '<svg viewBox="0 0 32 32"><rect x="6" y="6" width="20" height="21" rx="2"/><path d="M11 12h10M11 17h10M11 22h6"/></svg>',
		'chat'                 => '<svg viewBox="0 0 32 32"><path d="M6 8h20v13H14l-6 5v-5H6z"/></svg>',
		'assessment'           => '<svg viewBox="0 0 32 32"><circle cx="14" cy="14" r="7"/><path d="M19 19l7 7"/></svg>',
		'plan'                 => '<svg viewBox="0 0 32 32"><rect x="7" y="5" width="18" height="23" rx="2"/><path d="M12 5v3h8V5M11 14h10M11 19h10M11 24h6"/></svg>',
		'start'                => '<svg viewBox="0 0 32 32"><circle cx="16" cy="16" r="11"/><path d="M13 11l7 5-7 5z"/></svg>',
		'review'               => '<svg viewBox="0 0 32 32"><path d="M25 12a10 10 0 1 0 1 6"/><path d="M26 6v6h-6"/></svg>',
		'budget'               => '<svg viewBox="0 0 32 32"><rect x="5" y="9" width="22" height="15" rx="2"/><path d="M5 14h22M10 19h4"/></svg>',
		'education'            => '<svg viewBox="0 0 32 32"><path d="M3 12l13-6 13 6-13 6z"/><path d="M8 14.5V21c2 2 5 3 8 3s6-1 8-3v-6.5M29 12v7"/></svg>',
		'confidence'           => '<svg viewBox="0 0 32 32"><path d="M16 4l3.4 7 7.6 1.1-5.5 5.4 1.3 7.6L16 21.5l-6.8 3.6 1.3-7.6L5 12.1l7.6-1.1z"/></svg>',
		'routine'              => '<svg viewBox="0 0 32 32"><circle cx="16" cy="16" r="11"/><path d="M16 9v7l5 3"/></svg>',
		'wellbeing'            => '<svg viewBox="0 0 32 32"><path d="M16 26s-10-6.2-10-13a5.5 5.5 0 0 1 10-3.2A5.5 5.5 0 0 1 26 13c0 6.8-10 13-10 13z"/><path d="M9 15h4l2-3 2 6 2-3h4"/></svg>',
		'location'             => '<svg viewBox="0 0 32 32"><path d="M16 28s9-8.5 9-15a9 9 0 0 0-18 0c0 6.5 9 15 9 15z"/><circle cx="16" cy="13" r="3.2"/></svg>',
		'bed'                  => '<svg viewBox="0 0 32 32"><path d="M4 24V8M4 19h24v5M28 19v-4a4 4 0 0 0-4-4H14v8"/><circle cx="9" cy="15" r="2.5"/></svg>',
		'training'             => '<svg viewBox="0 0 32 32"><rect x="5" y="6" width="22" height="15" rx="2"/><path d="M11 26l5-5 5 5M10 11h12M10 15h7"/></svg>',
		'key'                  => '<svg viewBox="0 0 32 32"><circle cx="11" cy="16" r="5"/><path d="M16 16h12M24 16v4M20 16v3"/></svg>',
	);
}

/**
 * Echo an icon by key.
 *
 * @param string $key Icon key.
 */
function shc_icon( $key ) {
	$icons = shc_get_icons();
	if ( isset( $icons[ $key ] ) ) {
		echo $icons[ $key ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static theme SVG.
	}
}
