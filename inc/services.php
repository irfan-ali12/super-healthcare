<?php
/**
 * Care at Home service pages, keyed by page slug.
 *
 * Copy is based on the client's current service descriptions, the October 2026
 * brief and the latest CQC assessments. No pricing, response times or clinical
 * claims are made beyond what is verified.
 *
 * Dementia and Palliative use AI imagery on purpose: showing a real, identifiable
 * person on those pages would imply their diagnosis.
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;

/**
 * The five-step care journey from the brief.
 *
 * @return array<int, array{title: string, text: string}>
 */
function shc_care_journey() {
	return array(
		array(
			'title' => 'Talk to us',
			'text'  => 'Tell us what support may be needed and what matters most.',
		),
		array(
			'title' => 'Assessment',
			'text'  => 'We get to know your needs, routines, preferences, risks and goals.',
		),
		array(
			'title' => 'Agree the plan',
			'text'  => 'We confirm the support, the schedule and the costs with you.',
		),
		array(
			'title' => 'Start support',
			'text'  => 'We introduce your agreed care team and support begins.',
		),
		array(
			'title' => 'Review',
			'text'  => 'We adapt your support when your needs or circumstances change.',
		),
	);
}

/**
 * Shared FAQ answers.
 *
 * @param string $key Answer key.
 * @return string HTML.
 */
function shc_shared_faq( $key ) {
	switch ( $key ) {
		case 'checks':
			return 'Before anyone joins our team we complete a full and enhanced DBS check, a full work and life history, at least three references and a check of their right to work in the UK. New staff then complete compulsory training based on their qualifications and experience. <a href="' . shc_url( '/careers/' ) . '">Read more about how we recruit</a>.';
		case 'cost':
			return 'Costs depend on the support you need and when you need it. After your assessment we give you a written quotation, so you know exactly what is included before anything starts.';
		case 'funding':
			return 'Some people pay privately and some receive help from their local council or the NHS. Eligibility for funding is decided by the relevant body, not by us. You can <a href="https://www.gov.uk/apply-needs-assessment-social-services" target="_blank" rel="noopener">request a needs assessment from your council<span class="visually-hidden"> (opens in a new tab)</span></a>, and we are happy to talk you through the next steps.';
		case 'start':
			return 'That depends on the support needed and our availability in your area. After your assessment we will give you a realistic start date.';
		case 'medication':
			return 'Where it is agreed in your care plan, trained carers can prompt you to take your medicines or help you take them. Our latest CQC assessment notes mandatory training and competency checks for staff who support with medicines.';
		case 'change':
			return 'Yes. Your plan is reviewed regularly, and you or your family can ask for a review at any time if your needs or preferences change.';
	}
	return '';
}

/**
 * Service definitions.
 *
 * @return array<string, array<string, mixed>>
 */
function shc_get_services() {
	$journey = shc_care_journey();

	return array(
		'domcare'         => array(
			'title'            => 'DomCare Domiciliary Care at Home | Super Healthcare',
			'meta_description' => 'DomCare (domiciliary care): person-centred care visits in your own home in Westcliff-on-Sea and the surrounding area, planned around your routines.',
			'nav'              => 'DomCare (visiting care)',
			'card'             => 'Regular visits for personal care, medicines, meals and everyday tasks, at the times that suit you.',
			'kicker'           => 'DomCare (domiciliary care)',
			'h1'               => 'Care visits at home, planned around you',
			'intro'            => 'DomCare is our visiting care service. We agree what support you need, when visits happen and how they fit around your day, so you can stay safe and independent in your own home.',
			'image'            => 'carer-helping-client-shopping',
			'includes_title'   => 'What DomCare can include',
			'includes_intro'   => 'Every visit follows your care plan. You decide what help you want and how it is done.',
			'includes'         => array(
				array( 'icon' => 'personal-care', 'title' => 'Personal care', 'text' => 'Washing, dressing, grooming, toileting and moving safely around your home, with dignity and respect.' ),
				array( 'icon' => 'medication', 'title' => 'Medicines support', 'text' => 'Prompts or help with your medicines, as agreed in your care plan.' ),
				array( 'icon' => 'meals', 'title' => 'Meals and drinks', 'text' => 'Preparing meals and drinks the way you like them, including cultural and dietary needs.' ),
				array( 'icon' => 'household', 'title' => 'Help around the home', 'text' => 'Light cleaning, laundry, changing bedding and the practical tasks that keep your home comfortable.' ),
				array( 'icon' => 'shopping', 'title' => 'Shopping and appointments', 'text' => 'Errands, prescriptions, appointments and getting out to the places that matter to you.' ),
				array( 'icon' => 'companionship', 'title' => 'Company and conversation', 'text' => 'Time to talk, enjoy your interests and stay connected with family, friends and your community.' ),
			),
			'suits_title'      => 'Who DomCare may suit',
			'suits'            => array(
				'Adults of any age who want to stay at home with help at set times of the day',
				'People coming home from hospital who need support while they settle back in',
				'Families who want reliable help alongside the care they already give',
				'Anyone whose needs are changing and who wants support that can change too',
			),
			'suits_footer'     => 'If you need support through the day and night, <a href="' . shc_url( '/care-at-home/live-in-care/' ) . '">Live-in Care</a> may suit you better. We will talk it through with you.',
			'steps'            => $journey,
			'faqs'             => array(
				array( 'question' => 'How quickly can visits start?', 'answer' => shc_shared_faq( 'start' ) ),
				array( 'question' => 'Can visit times and frequency change?', 'answer' => shc_shared_faq( 'change' ) ),
				array( 'question' => 'Will I see the same carers?', 'answer' => 'We aim for continuity, so you get to know the people who support you. We introduce your care team before support begins.' ),
				array( 'question' => 'Can carers help with medicines?', 'answer' => shc_shared_faq( 'medication' ) ),
				array( 'question' => 'How are carers checked and trained?', 'answer' => shc_shared_faq( 'checks' ) ),
				array( 'question' => 'How much does DomCare cost?', 'answer' => shc_shared_faq( 'cost' ) ),
				array( 'question' => 'Can care be funded by the council?', 'answer' => shc_shared_faq( 'funding' ) ),
			),
			'related'          => array( 'live-in-care', 'respite-care', 'companionship' ),
			'cta_service'      => 'domcare',
		),

		'live-in-care'    => array(
			'title'            => 'Live-in Care at Home | Super Healthcare',
			'meta_description' => 'Fully managed live-in care: a carer lives in your home so you can stay independent and keep your routines, without moving into a care home.',
			'nav'              => 'Live-in Care',
			'card'             => 'A carer lives in your home, so you can keep your routines without moving into a care home.',
			'kicker'           => 'Live-in Care',
			'h1'               => 'Live-in care that keeps life familiar',
			'intro'            => 'Our fully managed live-in care service lets you stay in your own home, keep your routines and stay close to the people, pets and places you love, instead of moving into a care home.',
			'image'            => 'live-in-carers-with-client',
			'includes_title'   => 'What live-in care can include',
			'includes_intro'   => 'Your carer supports you through the day, in line with a care plan we build with you and review as your needs change.',
			'includes'         => array(
				array( 'icon' => 'personal-care', 'title' => 'Personal care', 'text' => 'Help with washing, dressing and moving around your home, at the times and in the way you prefer.' ),
				array( 'icon' => 'medication', 'title' => 'Medicines support', 'text' => 'Prompts or help with your medicines, as agreed in your care plan.' ),
				array( 'icon' => 'meals', 'title' => 'Meals and household tasks', 'text' => 'Cooking, laundry, cleaning and keeping your home running the way you like it.' ),
				array( 'icon' => 'shopping', 'title' => 'Errands and appointments', 'text' => 'Shopping, appointments and trips out, so life carries on as normal.' ),
				array( 'icon' => 'hobbies-community', 'title' => 'Hobbies, pets and community', 'text' => 'Support to keep up your interests, look after pets and stay part of your community.' ),
				array( 'icon' => 'family-communication', 'title' => 'Working with your family', 'text' => 'Agreed updates for family and coordination with professionals, always with your consent.' ),
			),
			'suits_title'      => 'Who live-in care may suit',
			'suits'            => array(
				'Adults who need a lot of daily support but want to stay in their own home',
				'Couples who want to stay together at home',
				'People returning home from hospital',
				'People living with dementia or changing needs',
			),
			'suits_footer'     => 'We match carers to people on needs, preferences and practical things such as experience and communication. We will always talk you through how matching works for you.',
			'steps'            => $journey,
			'faqs'             => array(
				array( 'question' => 'How is a live-in carer matched to me?', 'answer' => 'We look at your needs and preferences alongside each carer’s skills and experience. We will explain the options available to you before support begins.' ),
				array( 'question' => 'Is live-in care an alternative to a care home?', 'answer' => 'For many people, yes. Live-in care means you can stay in familiar surroundings with one-to-one support, rather than moving into a residential setting.' ),
				array( 'question' => 'Can carers help with medicines?', 'answer' => shc_shared_faq( 'medication' ) ),
				array( 'question' => 'How are carers checked and trained?', 'answer' => shc_shared_faq( 'checks' ) ),
				array( 'question' => 'How much does live-in care cost?', 'answer' => shc_shared_faq( 'cost' ) ),
				array( 'question' => 'Can live-in care be funded?', 'answer' => shc_shared_faq( 'funding' ) ),
			),
			'related'          => array( 'domcare', 'dementia-care', 'respite-care' ),
			'cta_service'      => 'live-in',
		),

		'respite-care'    => array(
			'title'            => 'Respite Care at Home | Super Healthcare',
			'meta_description' => 'Flexible respite care at home for a few hours during the day or overnight, giving family carers time to rest while routines carry on.',
			'nav'              => 'Respite Care',
			'card'             => 'Flexible cover for a few hours or overnight, so family carers can take a break.',
			'kicker'           => 'Respite Care',
			'h1'               => 'A trusted break for family carers',
			'intro'            => 'Caring for someone you love is rewarding and tiring. Our flexible respite care covers a few hours during the day or an overnight stay, so you can rest knowing familiar routines carry on at home.',
			'image'            => 'carer-walking-with-client-seafront',
			'includes_title'   => 'How respite care can help',
			'includes_intro'   => 'We plan respite around the person’s usual routines, so the change feels as natural as possible.',
			'includes'         => array(
				array( 'icon' => 'routine', 'title' => 'A few hours or overnight', 'text' => 'Cover during the day or overnight, arranged around what you need.' ),
				array( 'icon' => 'personal-care', 'title' => 'Personal care', 'text' => 'Help with washing, dressing, meals and moving around, following the person’s routine.' ),
				array( 'icon' => 'companionship', 'title' => 'Company and activities', 'text' => 'Conversation, walks and favourite activities, so time apart is enjoyable too.' ),
				array( 'icon' => 'heart', 'title' => 'Time for you', 'text' => 'Time to rest, see friends, attend appointments or simply recharge.' ),
			),
			'suits_title'      => 'Who respite care may suit',
			'suits'            => array(
				'Family members who are the main carer for an adult',
				'Families supporting someone with a disability or long-term condition',
				'People who need extra support after a stay in hospital',
				'Anyone who wants to try care at home before deciding on longer-term support',
			),
			'suits_footer'     => 'If you need regular support rather than occasional cover, take a look at <a href="' . shc_url( '/care-at-home/domcare/' ) . '">DomCare</a> visits.',
			'steps'            => $journey,
			'faqs'             => array(
				array( 'question' => 'How much notice do you need?', 'answer' => 'The more notice we have, the easier it is to plan. Please talk to us as early as you can and we will explain what we can arrange.' ),
				array( 'question' => 'Can respite be a regular arrangement?', 'answer' => 'Yes. Some families book respite occasionally, others arrange it on a regular basis. We will agree what works for you.' ),
				array( 'question' => 'How are carers checked and trained?', 'answer' => shc_shared_faq( 'checks' ) ),
				array( 'question' => 'How much does respite care cost?', 'answer' => shc_shared_faq( 'cost' ) ),
				array( 'question' => 'Can respite be funded?', 'answer' => shc_shared_faq( 'funding' ) ),
			),
			'related'          => array( 'domcare', 'live-in-care', 'companionship' ),
			'cta_service'      => 'respite',
		),

		'dementia-care'   => array(
			'title'            => 'Dementia Care at Home | Super Healthcare',
			'meta_description' => 'Specialist dementia care at home, including live-in support, built around familiar routines, communication and meaningful activity.',
			'nav'              => 'Dementia Care',
			'card'             => 'Specialist support at home, built around familiar routines and the person’s life story.',
			'kicker'           => 'Dementia Care',
			'h1'               => 'Dementia care in familiar surroundings',
			'intro'            => 'Staying at home can help a person living with dementia feel safe and settled. Our specialist support, including live-in care, is shaped around familiar routines, the person’s life story and what matters to them as their needs change.',
			'image'            => 'ai-dementia',
			'includes_title'   => 'How we support people living with dementia',
			'includes_intro'   => 'Support is personal, consistent and planned with the person and the people closest to them.',
			'includes'         => array(
				array( 'icon' => 'routine', 'title' => 'Familiar routines', 'text' => 'Keeping daily routines steady, which can reduce confusion and distress.' ),
				array( 'icon' => 'chat', 'title' => 'Patient communication', 'text' => 'Taking time to listen and communicate in the way that works best for the person.' ),
				array( 'icon' => 'hobbies-community', 'title' => 'Meaningful activity', 'text' => 'Hobbies, music, walks and conversations that bring enjoyment and connection.' ),
				array( 'icon' => 'meals', 'title' => 'Eating and drinking well', 'text' => 'Gentle support with meals and drinks, following likes, dislikes and dietary needs.' ),
				array( 'icon' => 'shield', 'title' => 'Safety at home', 'text' => 'Thinking ahead about risks at home while respecting independence and choice.' ),
				array( 'icon' => 'family-communication', 'title' => 'Partnership with family', 'text' => 'Regular, agreed communication with family and the professionals involved.' ),
			),
			'suits_title'      => 'Who dementia care may suit',
			'suits'            => array(
				'People living with dementia who want to stay in their own home',
				'Families who want support that can increase as needs change',
				'People who would benefit from the consistency of a live-in carer',
			),
			'suits_footer'     => 'Many people living with dementia choose <a href="' . shc_url( '/care-at-home/live-in-care/' ) . '">Live-in Care</a> for one-to-one support around the clock.',
			'steps'            => $journey,
			'faqs'             => array(
				array( 'question' => 'Can someone with dementia stay at home as needs increase?', 'answer' => 'Often, yes. We review support regularly and can increase it over time, including live-in care. We will always be honest with you about what we can safely provide.' ),
				array( 'question' => 'How do you involve the family?', 'answer' => 'We agree with the person and their family how updates and reviews will work, respecting the person’s consent and capacity.' ),
				array( 'question' => 'Is dementia one of your CQC registered specialisms?', 'answer' => 'Yes. Dementia is listed among our service specialisms on our CQC profile.' ),
				array( 'question' => 'How are carers checked and trained?', 'answer' => shc_shared_faq( 'checks' ) ),
				array( 'question' => 'How much does dementia care cost?', 'answer' => shc_shared_faq( 'cost' ) ),
			),
			'related'          => array( 'live-in-care', 'respite-care', 'domcare' ),
			'cta_service'      => 'dementia',
		),

		'palliative-care' => array(
			'title'            => 'Palliative Care at Home | Super Healthcare',
			'meta_description' => 'Compassionate palliative care at home focused on comfort, dignity and personal choice, working alongside the GP, district nurses and hospice teams.',
			'nav'              => 'Palliative Care',
			'card'             => 'Comfort, dignity and personal choice at home, working alongside the healthcare team.',
			'kicker'           => 'Palliative Care',
			'h1'               => 'Comfort, dignity and choice at home',
			'intro'            => 'Our palliative care helps adults remain at home with the support they need. We focus on comfort, dignity and personal wishes, and work alongside the GP, district nurses, hospice teams and family.',
			'image'            => 'ai-palliative',
			'includes_title'   => 'How we support people at home',
			'includes_intro'   => 'Our carers provide personal care and practical support. Clinical care and prescribing stay with the person’s GP, nurses and specialist teams.',
			'includes'         => array(
				array( 'icon' => 'personal-care', 'title' => 'Personal care and comfort', 'text' => 'Gentle help with washing, dressing, positioning and comfort, at the person’s own pace.' ),
				array( 'icon' => 'heart', 'title' => 'Wishes and preferences', 'text' => 'Respecting personal, spiritual and cultural wishes, and how the person wants to spend their time.' ),
				array( 'icon' => 'family-communication', 'title' => 'Working with professionals', 'text' => 'Following the plans set by the GP, district nurses and hospice, and sharing updates as agreed.' ),
				array( 'icon' => 'companionship', 'title' => 'Support for family', 'text' => 'Being a steady presence for family, so they can spend time together rather than on tasks.' ),
			),
			'suits_title'      => 'Who palliative care may suit',
			'suits'            => array(
				'Adults with a life-limiting illness who wish to be cared for at home',
				'Families who want practical support alongside healthcare professionals',
				'People returning home from hospital or a hospice',
			),
			'suits_footer'     => 'For one-to-one support through the day and night, palliative care can be provided as <a href="' . shc_url( '/care-at-home/live-in-care/' ) . '">live-in care</a>.',
			'steps'            => $journey,
			'faqs'             => array(
				array( 'question' => 'Do your carers provide clinical or nursing care?', 'answer' => 'Our carers provide personal care and practical support. Clinical care, symptom management and prescribing remain with the person’s GP, district nurses and specialist palliative teams, and we work alongside them.' ),
				array( 'question' => 'Can care be arranged quickly?', 'answer' => 'We understand time can matter. Please call us and we will explain what we can arrange and how quickly.' ),
				array( 'question' => 'Who do we contact in an emergency?', 'answer' => 'Always call 999 in an emergency. For urgent medical advice, call NHS 111 or follow the plan agreed with the person’s healthcare team.' ),
				array( 'question' => 'How much does palliative care cost?', 'answer' => shc_shared_faq( 'cost' ) ),
				array( 'question' => 'Can palliative care be funded?', 'answer' => 'Some people may be eligible for NHS Continuing Healthcare or council support. Eligibility is decided by the NHS or council, and we are happy to explain the next steps.' ),
			),
			'related'          => array( 'live-in-care', 'domcare', 'respite-care' ),
			'cta_service'      => 'palliative',
		),

		'companionship'   => array(
			'title'            => 'Companionship and Social Support | Super Healthcare',
			'meta_description' => 'Companionship at home and in the community: conversation, outings, shopping, appointments and hobbies with a friendly, trusted carer.',
			'nav'              => 'Companionship',
			'card'             => 'Company, outings and a helping hand to stay connected with your community.',
			'kicker'           => 'Companionship',
			'h1'               => 'Company, confidence and connection',
			'intro'            => 'Sometimes the most valuable support is time together. Our companionship service offers friendly company and a helping hand to get out, keep up your interests and stay connected.',
			'image'            => 'companionship-lunch-out',
			'includes_title'   => 'What companionship can include',
			'includes_intro'   => 'You choose how you spend the time. Here are some of the things people enjoy.',
			'includes'         => array(
				array( 'icon' => 'chat', 'title' => 'Conversation', 'text' => 'A friendly chat over a cup of tea, at home or out and about.' ),
				array( 'icon' => 'hobbies-community', 'title' => 'Outings and walks', 'text' => 'Trips to the seafront, the shops, a cafe or somewhere new.' ),
				array( 'icon' => 'shopping', 'title' => 'Shopping and appointments', 'text' => 'Company and practical help with errands and appointments.' ),
				array( 'icon' => 'confidence', 'title' => 'Hobbies and interests', 'text' => 'Support to keep up the activities you love, or try something new.' ),
			),
			'suits_title'      => 'Who companionship may suit',
			'suits'            => array(
				'Adults who are mostly independent but would enjoy regular company',
				'People who would like support to get out and about with confidence',
				'Families who live further away and want reassurance',
			),
			'suits_footer'     => 'Companionship does not include personal care. If you need help with washing, dressing or medicines, <a href="' . shc_url( '/care-at-home/domcare/' ) . '">DomCare</a> visits can include company too.',
			'steps'            => $journey,
			'faqs'             => array(
				array( 'question' => 'Does companionship include personal care?', 'answer' => 'No. Companionship focuses on company and practical help. If personal care is needed, we can arrange DomCare visits instead.' ),
				array( 'question' => 'Can we go out together?', 'answer' => 'Yes. Outings are agreed in your plan, and we think ahead about anything that would make them safe and enjoyable.' ),
				array( 'question' => 'How are carers checked and trained?', 'answer' => shc_shared_faq( 'checks' ) ),
				array( 'question' => 'How much does companionship cost?', 'answer' => shc_shared_faq( 'cost' ) ),
			),
			'related'          => array( 'domcare', 'respite-care', 'live-in-care' ),
			'cta_service'      => 'companionship',
		),
	);
}
