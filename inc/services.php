<?php
/**
 * Adult care service page data keyed by page slug.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string, array<string, mixed>>
 */
function shc_get_services() {
	$steps_default = array(
		array(
			'title' => 'Talk to us',
			'text'  => 'About what is changing and what matters most.',
		),
		array(
			'title' => 'Home assessment',
			'text'  => 'With you and, where appropriate, family or professionals.',
		),
		array(
			'title' => 'Personal care plan',
			'text'  => 'Schedule, outcomes and communication preferences.',
		),
		array(
			'title' => 'Matched support',
			'text'  => 'Based on needs, preferences, skills and availability.',
		),
		array(
			'title' => 'Review',
			'text'  => 'We adapt the plan when needs or choices change.',
		),
	);

	return array(
		'domcare'         => array(
			'title'              => 'DomCare Domiciliary Care | Super Healthcare',
			'meta_description'   => 'DomCare (domiciliary care): reliable, person-centred care visits in your own home, planned around your routines. Request a home assessment.',
			'body_class'         => 'theme-adult',
			'breadcrumb'         => 'DomCare',
			'kicker'             => 'DomCare (domiciliary care)',
			'h1'                 => 'DomCare built around you',
			'intro'              => 'Reliable, person-centred care in your own home. We agree what support is needed, when it should happen and how it fits around your everyday routines.',
			'hero_image'         => 'img/respite-care.webp',
			'hero_alt'           => 'An older woman laughing with her carer over a cup of tea at home',
			'includes_title'     => 'What DomCare can include',
			'includes_intro'     => 'Every visit follows your care plan. You choose what help you want and how it is done.',
			'includes'           => array(
				array(
					'title' => 'Personal care',
					'text'  => 'Support with washing, dressing, grooming, toileting and moving safely around the home, delivered with dignity and respect.',
					'icon'  => 'personal-care',
				),
				array(
					'title' => 'Medication support',
					'text'  => 'Prompts or authorised assistance in line with your agreed care plan and our procedures.',
					'icon'  => 'medication',
				),
				array(
					'title' => 'Meals and hydration',
					'text'  => 'Meal preparation shaped around your preferences, routines, cultural needs and agreed dietary requirements.',
					'icon'  => 'meals',
				),
				array(
					'title' => 'Household help',
					'text'  => 'Light cleaning, laundry, changing bedding and practical tasks that keep your home safe and comfortable.',
					'icon'  => 'household',
				),
				array(
					'title' => 'Shopping and appointments',
					'text'  => 'Help with errands, shopping, prescriptions, healthcare appointments and essential journeys.',
					'icon'  => 'shopping',
				),
				array(
					'title' => 'Companionship',
					'text'  => 'Conversation, shared interests, walks and hobbies, and support to stay connected with family, friends and your community.',
					'icon'  => 'companionship',
				),
				array(
					'title' => 'Family communication',
					'text'  => 'Agreed updates and reviews with family, respecting your consent, privacy and preferences.',
					'icon'  => 'family-communication',
				),
			),
			'suits_title'        => 'Who DomCare may suit',
			'suits'              => array(
				'Adults and older people who want to stay living at home with help at set times of day',
				'People coming home from hospital who need support while they settle back in',
				'Families who want reliable help alongside the care they already give',
				'Anyone whose needs are changing and who wants support that can grow with them',
			),
			'suits_footer_html'  => 'If you need support through the day and night, <a href="' . esc_url( shc_url( '/adult-care-at-home/live-in-care/' ) ) . '">Live-in Care</a> may be a better fit. We will talk it through with you.',
			'steps'              => $steps_default,
			'faq_title'          => 'DomCare questions',
			'faqs'               => array(
				array(
					'question' => 'How quickly can care start?',
					'answer'   => 'It depends on your needs and our availability in your area. We will give you a realistic start date after your assessment. <span class="placeholder-inline">[Client to confirm typical timescale]</span>',
				),
				array(
					'question' => 'Is there a minimum visit length?',
					'answer'   => '<span class="placeholder-inline">[Client to confirm minimum visit length]</span>',
				),
				array(
					'question' => 'Can visit times and frequency change?',
					'answer'   => 'Yes. Your care plan is reviewed regularly, and you can ask to change visit times or frequency at any time. We will confirm what we can arrange.',
				),
				array(
					'question' => 'Will I see the same carers?',
					'answer'   => 'We aim for continuity so you get to know the people supporting you. <span class="placeholder-inline">[Client to confirm how teams are organised]</span>',
				),
				array(
					'question' => 'Can carers support medication?',
					'answer'   => 'Carers can prompt or assist with medication where this is agreed in your care plan and in line with our procedures. <span class="placeholder-inline">[Wording to be approved by Registered Manager]</span>',
				),
				array(
					'question' => 'How are carers checked and trained?',
					'answer'   => '<span class="placeholder-inline">[Client to confirm recruitment checks and training]</span> <a href="' . esc_url( shc_url( '/about/our-approach/' ) ) . '">Read about our approach</a>.',
				),
				array(
					'question' => 'How much does DomCare cost?',
					'answer'   => 'Costs depend on how much support you need and when. We provide an individual quotation after your home assessment.',
				),
				array(
					'question' => 'Can care be funded through direct payments or other support?',
					'answer'   => 'Many people use local council funding or direct payments. Start with a <a href="https://www.gov.uk/apply-needs-assessment-social-services" target="_blank" rel="noopener">needs assessment from your council<span class="visually-hidden"> (opens in a new tab)</span></a>, and we can talk you through the next steps.',
				),
			),
			'related'            => array(
				array(
					'slug'  => 'live-in-care',
					'title' => 'Live-in Care',
					'text'  => 'Support around the clock in your own home',
				),
				array(
					'slug'  => 'respite-care',
					'title' => 'Respite Care',
					'text'  => 'Short-term cover so family carers can rest',
				),
				array(
					'slug'  => 'companionship',
					'title' => 'Companionship',
					'text'  => 'Company, confidence and connection',
				),
			),
			'cta_service'        => 'domcare',
			'cta_button'         => 'Request a home assessment',
		),
		'live-in-care'    => shc_service_todo(
			'live-in-care',
			'Live-in Care | Super Healthcare',
			'Live-in care at home from Super Healthcare. TODO: meta description from client.',
			'Live-in Care',
			'Live-in Care built around you',
			'TODO: Hero intro copy for Live-in Care.',
			'img/live-in-care.webp',
			'An older man and his carer smiling in a garden',
			'live-in',
			$steps_default
		),
		'respite-care'    => shc_service_todo(
			'respite-care',
			'Respite Care | Super Healthcare',
			'Respite care at home from Super Healthcare. TODO: meta description from client.',
			'Respite Care',
			'Respite Care built around you',
			'TODO: Hero intro copy for Respite Care.',
			'img/respite-care.webp',
			'An older woman holding a mug and chatting with a visitor on her sofa',
			'respite',
			$steps_default
		),
		'dementia-care'   => shc_service_todo(
			'dementia-care',
			'Dementia Care | Super Healthcare',
			'Dementia care at home from Super Healthcare. TODO: meta description from client.',
			'Dementia Care',
			'Dementia Care built around you',
			'TODO: Hero intro copy for Dementia Care.',
			'img/dementia-care.webp',
			'An older man in a flat cap walking outdoors with his carer',
			'dementia',
			$steps_default
		),
		'palliative-care' => shc_service_todo(
			'palliative-care',
			'Palliative Care | Super Healthcare',
			'Palliative care at home from Super Healthcare. TODO: meta description from client.',
			'Palliative Care',
			'Palliative Care built around you',
			'TODO: Hero intro copy for Palliative Care.',
			'img/palliative-care.webp',
			'A carer sitting close beside an older woman at home',
			'palliative',
			$steps_default
		),
		'companionship'   => shc_service_todo(
			'companionship',
			'Companionship | Super Healthcare',
			'Companionship at home from Super Healthcare. TODO: meta description from client.',
			'Companionship',
			'Companionship built around you',
			'TODO: Hero intro copy for Companionship.',
			'img/dementia-care.webp',
			'An older man enjoying a walk and conversation with his carer',
			'companionship',
			$steps_default
		),
	);
}

/**
 * Minimal service entry marked for client copy.
 *
 * @param string               $slug   Page slug.
 * @param string               $title  Document title.
 * @param string               $meta   Meta description.
 * @param string               $crumb  Breadcrumb label.
 * @param string               $h1     Heading.
 * @param string               $intro  Intro.
 * @param string               $image  Asset path under assets/.
 * @param string               $alt    Image alt.
 * @param string               $cta    CTA query service value.
 * @param array<int, array>    $steps  Steps list.
 * @return array<string, mixed>
 */
function shc_service_todo( $slug, $title, $meta, $crumb, $h1, $intro, $image, $alt, $cta, $steps ) {
	return array(
		'title'              => $title,
		'meta_description'   => $meta,
		'body_class'         => 'theme-adult',
		'breadcrumb'         => $crumb,
		'kicker'             => $crumb,
		'h1'                 => $h1,
		'intro'              => $intro,
		'hero_image'         => $image,
		'hero_alt'           => $alt,
		'includes_title'     => 'TODO: What this service includes — section title',
		'includes_intro'     => 'TODO: Includes section intro.',
		'includes'           => array(
			array(
				'title' => 'TODO: Include item 1',
				'text'  => 'TODO: Include item 1 description.',
				'icon'  => 'personal-care',
			),
		),
		'suits_title'        => 'TODO: Who this service may suit',
		'suits'              => array( 'TODO: Suitability bullet 1' ),
		'suits_footer_html'  => 'TODO: Optional footer paragraph with links.',
		'steps'              => $steps,
		'faq_title'          => 'TODO: FAQ section title',
		'faqs'               => array(
			array(
				'question' => 'TODO: FAQ question 1',
				'answer'   => 'TODO: FAQ answer 1',
			),
		),
		'related'            => array(
			array(
				'slug'  => 'domcare',
				'title' => 'DomCare',
				'text'  => 'Flexible care visits at home',
			),
		),
		'cta_service'        => $cta,
		'cta_button'         => 'Request a home assessment',
	);
}
