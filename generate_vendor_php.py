import os
import base64
from ftplib import FTP

# Read all files in the polyfill packages that are incomplete
# Build a single PHP script that creates all files inline

packages_to_fix = [
    'vendor/symfony/polyfill-mbstring',
    'vendor/symfony/polyfill-intl-grapheme',
    'vendor/symfony/polyfill-php83',
    'vendor/laravel/prompts',
    'vendor/nunomaduro/termwind',
    'vendor/ramsey/uuid',
    'vendor/ralouphie/getallheaders',
    'vendor/brick/math',
    'vendor/carbonphp/carbon-doctrine-types',
    'vendor/dflydev/dot-access-data',
    'vendor/dragonmantank/cron-expression',
    'vendor/egulias/email-validator',
    'vendor/fruitcake/php-cors',
    'vendor/guzzlehttp/promises',
    'vendor/guzzlehttp/psr7',
    'vendor/guzzlehttp/uri-template',
    'vendor/guzzlehttp/guzzle',
    'vendor/laravel/tinker',
    'vendor/league/commonmark',
    'vendor/league/config',
    'vendor/league/flysystem',
    'vendor/league/flysystem-local',
    'vendor/league/mime-type-detection',
    'vendor/monolog/monolog',
    'vendor/nesbot/carbon',
    'vendor/nette/schema',
    'vendor/nette/utils',
    'vendor/phpoption/phpoption',
    'vendor/psr/clock',
    'vendor/psr/container',
    'vendor/psr/event-dispatcher',
    'vendor/psr/http-client',
    'vendor/psr/http-factory',
    'vendor/psr/http-message',
    'vendor/psr/log',
    'vendor/psr/simple-cache',
    'vendor/vlucas/phpdotenv',
]

php_lines = ['<?php', 'set_time_limit(300);', 'error_reporting(E_ALL);', 'ini_set("display_errors", 1);', '$count = 0; $errors = 0;', '']

def add_file(php_lines, local_path, base_dir=''):
    """Add a file creation statement to PHP script"""
    with open(local_path, 'rb') as f:
        content = f.read()
    
    b64 = base64.b64encode(content).decode('utf-8')
    rel_path = local_path.replace('\\', '/')
    remote_path = '__DIR__ . "/' + rel_path + '"'
    dir_path = '__DIR__ . "/' + '/'.join(rel_path.split('/')[:-1]) + '"'
    
    php_lines.append(f'@mkdir({dir_path}, 0755, true);')
    php_lines.append(f'if (file_put_contents({remote_path}, base64_decode("{b64}"))) {{ $count++; }} else {{ $errors++; echo "FAIL: {rel_path}<br>"; }}')

total_files = 0
for pkg in packages_to_fix:
    if not os.path.exists(pkg):
        continue
    for root, dirs, files in os.walk(pkg):
        for file in files:
            local_path = os.path.join(root, file)
            # Skip binary files > 50KB to keep PHP script manageable
            if os.path.getsize(local_path) > 50000:
                continue
            add_file(php_lines, local_path)
            total_files += 1

php_lines.append('')
php_lines.append('echo "<b style=\'color:green\'>Done! Created $count files, $errors errors.</b><br>";')
php_lines.append('echo "<a href=\'/\'>Open website</a>";')
php_lines.append('?>')

php_script = '\n'.join(php_lines)
print(f"PHP script size: {len(php_script)/1024:.0f} KB, covering {total_files} files")

with open('/tmp/create_vendor_files.php', 'w') as f:
    f.write(php_script)

# Upload it
print("Connecting to FTP...")
ftp = FTP('ftpupload.net')
ftp.login('if0_42562646', 'Arkanza0123456')
ftp.cwd('htdocs')

print("Uploading create_vendor_files.php...")
with open('/tmp/create_vendor_files.php', 'rb') as f:
    ftp.storbinary('STOR create_vendor_files.php', f)

ftp.quit()
print(f"Done! PHP script uploaded with {total_files} embedded files.")
print("Now open: http://lesrenangjogja.site.je/create_vendor_files.php")
