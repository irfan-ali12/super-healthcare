# Super Healthcare child theme (v2.0)

Parent theme: **Twenty Twenty-Five**. No page builder, no ACF, no plugins required.

Built from the October 2026 briefs: *Website Improvement & Client Experience Brief* and
*Supported Living Only Content Brief*, plus the client's hero feedback ("the website must
start here, with two photos representing adult care and supported living in blue and red").

## Install / upgrade

1. Upload this folder to `wp-content/themes/super-healthcare` (replace the old one).
2. If the theme is already active, visit any admin page once. The upgrade runs automatically:
   - renames the 1.x pages in place (same IDs, nothing duplicated or deleted):
     `adult-care-at-home` → `care-at-home`, `supported-accommodation` → `supported-living`,
     `professionals` → `referrals`, `stories` → `our-community`, `about` → `about-us`,
     `work-with-us` → `careers`
   - sets retired 1.x sub-pages (Our homes, Life skills, Easy Read, Team, etc.) to **draft**
   - creates any missing pages and keeps Home as the static front page
   - clears old placeholder settings so the verified defaults apply
3. Manual re-sync any time: **Tools → Super Healthcare pages**, or `wp shc create-pages`.

## Admin

**Settings → Super Healthcare**
- Contact details, CQC links and dates, Registered Manager. Verified values are built in as defaults.
- Supported Living availability (with an automatic hide-after date).
- Enquiry routing: Care at Home, Supported Living and Professional referrals can each go to a different inbox.
- **Homepage hero images**: swap the blue (Care at Home) and red (Supported Living) photos from the Media Library. No code needed.

**Stories** (left admin menu): add approved testimonials. A story only appears on the site
once it is published **and** has a consent reference, so placeholder quotes can never show.

**Page owner / last reviewed** box on every page (shown at the foot of policy pages).

## Site structure

| URL | Template |
| --- | --- |
| `/` | `templates/front-page.php` |
| `/care-at-home/` | `templates/template-hub.php` |
| `/care-at-home/{domcare, live-in-care, respite-care, dementia-care, palliative-care, companionship}/` | `templates/template-service.php` (copy in `inc/services.php`) |
| `/supported-living/` | `templates/template-supported-living.php` |
| `/referrals/` | `templates/template-referrals.php` |
| `/our-community/` | `templates/template-community.php` |
| `/about-us/` | `templates/template-about.php` |
| `/about-us/quality-and-cqc/` | `templates/template-quality.php` |
| `/careers/` | `templates/template-careers.php` |
| `/contact/` | `templates/template-contact.php` |
| everything else | `templates/page.php` (editor content) |

**301 redirects** (`inc/pages.php`) cover the 1.x URLs and the current live site's URLs
(`/live-in-care`, `/services`, `/book-an-introduction`, `/contact-us`, `/recruitment`,
`/testimonials`, `/privacy-policy`, `/Home`, …).

**Images**: `inc/images.php` is the single registry (file, alt text, focal point, srcset).
Real photos are in `assets/img/photos/` (WebP, 800 and 1600 px), converted from the client's
`assets/img/new-images/` folder. AI images are in `assets/img/ai/`. These are the client's own
infographic artwork, upscaled with an EDSR model. Registered images can use either the usual
`-800.webp`/`-1600.webp` pair or a single `<image-key>.webp` file.

The header, footer and organization schema use `assets/img/new-images/superhealthcare-logo.jpg`.
Theme asset URLs include each file's modification time to avoid stale browser/CDN copies. After
uploading a theme update, purge any full-page or CDN cache so the site serves the updated markup.

**Tracking**: buttons carry `data-track` attributes, and `main.js` pushes `shc_*` events to
`window.dataLayer` **only if** an analytics tool has created it (after cookie consent). No
names, emails, phone numbers or message text are ever sent.

## Before launch: needs client confirmation

Nothing below is shown as a placeholder on the site. Unconfirmed items are either hidden or
written so they make no claim. Each still needs sign-off.

**Photography and consent**
- [ ] Written consent for every identifiable person in `new-images` (brief s.13A). Residents appear on Supported Living, Our Community and the Care at Home pages.
- [ ] Confirm the kitchen, dining, lounge and garden photos are of **234 Hamlet Court Road** (they are shown in its property gallery).
- [ ] Dementia and Palliative pages deliberately use AI images. A real, identifiable person there would imply their diagnosis.

**Services and claims**
- [ ] **Companionship**: in the September 2026 brief but not on the current live site. Operations to confirm it is offered.
- [ ] CTA wording "Arrange a **free** care assessment" (brief s.5) and "written quotation after assessment" (brief s.11).
- [ ] "We aim to respond to all requests within 24 hours". Taken from the current site. Clear it in Settings if Operations cannot confirm it for every enquiry type.
- [ ] Approval to name the Registered Manager (brief s.10). Clear the field in Settings to hide it.

**Content still to supply** (pages exist and show a "contact our office" line until filled)
- [ ] Safeguarding, Complaints, Policies, Privacy notice, Cookies, Accessibility statement.
- [ ] Office hours and out-of-hours wording (hidden until entered).
- [ ] Care at Home service areas and postcodes; Supported Living capacity, exclusions and funding routes.
- [ ] Approved stories and testimonials (Stories menu).
- [ ] Cookie consent and analytics setup (no analytics is installed by the theme).

## AI image prompts (homepage hero)

The current homepage hero uses the client's infographic artwork (blue) and a real photo of
the home (red). To replace either with a fresh AI image, generate it, upload it to the Media
Library and select it in **Settings → Super Healthcare → Homepage hero images**.

Size: landscape **16:9, at least 2400 × 1350 px**. Keep the subject in the **upper two-thirds**
(the coloured label covers the bottom of the panel) and slightly off-centre.

**Blue: Care at Home**
> Natural documentary-style photograph, a warm UK living room in daylight. An older man in his late seventies sits in his own armchair, laughing with a female home carer in a plain navy polo shirt who kneels beside him holding a mug of tea. Genuine, relaxed expressions, soft window light, homely details (cushions, plants, family photos). Shallow depth of field, Canon 35mm look. No text, no logos, no uniforms with branding, no hospital equipment.

**Red: Supported Living (adults 18+, no upper age limit)**
> Natural documentary-style photograph, a bright modern shared kitchen in a UK supported-living home. Three adults of clearly different ages (around 25, 50 and 70) prepare a meal together with a support worker in casual clothes. One chops vegetables, one sets the table, everyone relaxed and smiling. Daylight, clean white units, plants on the windowsill. Show independence and everyday life, not care or illness. No text, no logos, no clinical items.

**Optional replacements**
- Dementia Care: *an older woman and a carer looking through a photo album together at a kitchen table, warm daylight, calm and engaged, documentary style, no text.*
- Palliative Care: *a carer gently adjusting a blanket for an older man resting in an armchair by a window at home, his daughter beside him holding his hand, soft light, dignified, no medical equipment in focus, no text.*

Save them at 1600 px wide as WebP in `assets/img/ai/` using the existing file names
(`ai-dementia-1600.webp` / `-800.webp`) to swap them without code changes.

## Changes in 2.1 (client feedback, 19 October 2026)

- The "providing a unique care experience" logo is used from `assets/img/new-images/superhealthcare-logo.jpg`.
- Menu items larger and bolder, with a red colour-fill on hover.
- Homepage "Care at Home" panel is black; Supported Living stays red.
- "People first. Independence always." removed everywhere and replaced with "Person-centred visiting home care, shaped around you."
- CQC "Good" circle is green. New homecare.co.uk **9.5 out of 10** circle beside it (30 reviews, checked 19 Oct 2026). Change or hide it in **Settings → Super Healthcare → homecare.co.uk review score**.
- Footer row with the CQC, homecare.co.uk and NHS logos, linked to the CQC profile, the homecare.co.uk reviews page and Super Healthcare's NHS website listing. All three links are editable in Settings.
- Light-red background panels removed sitewide (solid red bands kept).
- Comparison table header is black.
- **Mulish** is the body font (it matches the logo), with Source Serif 4 for headings. Both are **self-hosted** in `assets/fonts/` (SIL Open Font License, about 80 KB total), so no visitor data goes to Google Fonts.
- Our Community: category buttons are bolder with a red fill on hover, and photo captions are bold.
- Header: the full phone number shows on screens wider than 1440px; below that, a round phone icon (tap to call) takes its place.
- The homecare.co.uk 9.5 circle appears only in the footer, above the homecare.co.uk logo (removed from the hero).
