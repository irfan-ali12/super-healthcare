"""Patch converted content PHP for dynamic phone/CQC."""
import re, glob, os

CONTENT = os.path.join(os.path.dirname(os.path.dirname(os.path.abspath(__file__))), 'templates', 'content')

PHONE_HREF = 'href="<?php echo esc_url( shc_phone_href() ); ?>"'
PHONE_LINK = 'href="<?php echo esc_url( shc_phone_href() ); ?>"'

def patch(text):
    text = text.replace('href="tel:01702333120"', PHONE_HREF)
    text = re.sub(
        r'(<a class="btn btn--outline" [^>]*>)Call 01702 333 120</a>',
        r'\1Call <?php shc_echo_phone(); ?></a>',
        text,
    )
    text = re.sub(
        r'(<a class="cta-phone" [^>]*>.*?<span>)Call 01702 333 120(</span></a>)',
        r'\1Call <?php shc_echo_phone(); ?>\2',
        text,
        flags=re.S,
    )
    text = re.sub(
        r'(<a class="aside-phone" [^>]*>)01702 333 120</a>',
        r'\1<?php shc_echo_phone(); ?></a>',
        text,
    )
    text = text.replace(
        'https://www.cqc.org.uk/location/1-6575573200',
        '<?php echo esc_url( shc_cqc_url_or_default() ); ?>',
    )
    text = text.replace(
        '[CQC publication date]',
        '<?php shc_echo_cqc_date(); ?>',
    )
    text = text.replace(
        '[date]',
        '<?php shc_echo_cqc_date(); ?>',
    )
    text = text.replace(
        '[confirm hours]',
        '<?php shc_echo_office_hours(); ?>',
    )
    return text

for f in glob.glob(os.path.join(CONTENT, '*.php')):
    s = open(f, encoding='utf-8').read()
    s2 = patch(s)
    if s2 != s:
        open(f, 'w', encoding='utf-8').write(s2)
        print('patched', os.path.basename(f))
