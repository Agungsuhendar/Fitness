const puppeteer = require('/tmp/node_modules/puppeteer-core');
const fs = require('fs');
const { execSync } = require('child_process');

(async () => {
    console.log("Preparing profile copy...");
    try {
        // Sync cookies and login state
        execSync('mkdir -p /tmp/chrome_profile/Default && cp -R "$HOME/Library/Application Support/Google/Chrome/Default/Cookies" "$HOME/Library/Application Support/Google/Chrome/Default/Network" /tmp/chrome_profile/Default/ 2>/dev/null || true');

        const browser = await puppeteer.launch({
            executablePath: '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',
            userDataDir: '/tmp/chrome_profile',
            headless: true,
            args: ['--no-sandbox', '--disable-setuid-sandbox']
        });

        const page = await browser.newPage();
        console.log("Opening InfinityFree Dashboard...");
        await page.goto('https://dash.infinityfree.com/accounts', { waitUntil: 'networkidle2', timeout: 30000 });

        const url = page.url();
        const title = await page.title();
        console.log(`Page Loaded: ${title} (${url})`);

        await page.screenshot({ path: '/tmp/infinityfree_dash.png' });
        
        // Extract links or account info
        const content = await page.content();
        fs.writeFileSync('/tmp/infinityfree_page.html', content);

        await browser.close();
        console.log("Done checking dashboard!");
    } catch (err) {
        console.error("Automation error:", err.message);
    }
})();
