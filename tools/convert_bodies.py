"""Convert src/*.html bodies to templates/content/*.php with shc_url/shc_asset helpers."""
import re, glob, os

ROOT = os.path.dirname(os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
SRC = os.path.join(ROOT, 'src')
OUT = os.path.join(os.path.dirname(os.path.dirname(os.path.abspath(__file__))), 'templates', 'content')
os.makedirs(OUT, exist_ok=True)

SKIP_PHP_BLOCKS = {
    'index.html': ['trust-strip', 'cqc-seal', 'quality-list first cqc'],
    'adult-care-at-home.html': ['trust-panel', 'cqc-seal'],
    'supported-accommodation.html': ['notice', 'availability'],
    'contact.html': ['form entire - use template-contact'],
}

def convert_links(html):
    def repl_href(m):
        href = m.group(1)
        if href.startswith(('http://', 'https://', 'mailto:', 'tel:', '#')):
            return m.group(0)
        return 'href="<?php echo shc_url(\'%s\'); ?>"' % href.rstrip('/') + ('/' if href != '/' and not href.endswith('/') else '')
    # Fix: simpler approach
    def href_repl(m):
        href = m.group(1)
        if href.startswith(('http://', 'https://', 'mailto:', 'tel:', '#')):
            return 'href="%s"' % href
        path = href if href.startswith('/') else '/' + href
        if path != '/' and not path.endswith('/'):
            path = path + '/'
        return "href=\"<?php echo shc_url('%s'); ?>\"" % path
    html = re.sub(r'href="([^"]+)"', href_repl, html)
    html = re.sub(
        r'src="assets/([^"]+)"',
        lambda m: "src=\"<?php echo shc_asset('%s'); ?>\"" % m.group(1),
        html,
    )
    return html

for f in glob.glob(os.path.join(SRC, '*.html')):
    name = os.path.basename(f)
    if name == 'domcare.html':
        continue  # rendered from services data
    if name == 'page.html':
        continue
    if name == 'contact.html':
        continue
    s = open(f, encoding='utf-8').read()
    m = re.match(r'\{\{meta .*?\}\}\n', s, re.S)
    if m:
        s = s[m.end():]
    s = convert_links(s)
    # Strip outer main tags - templates wrap main
    s = re.sub(r'^<main id="main">\n', '', s)
    s = re.sub(r'\n</main>\s*$', '', s)
    out_name = name.replace('.html', '.php')
    php = '<?php\n/** Auto-converted from src/%s — dynamic phone/CQC/settings handled in parent template where noted. */\n?>\n' % name
    php += s
    open(os.path.join(OUT, out_name), 'w', encoding='utf-8').write(php)
    print('wrote', out_name)
