const http = require('http');
const fs = require('fs');
const { spawn } = require('child_process');

const edgePath = 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe';
const edge = spawn(edgePath, [
  '--headless',
  '--remote-debugging-port=9222',
  '--window-size=390,844',
  '--disable-gpu',
  'about:blank'
]);

function getJson(url) {
  return new Promise((resolve, reject) => {
    http.get(url, (res) => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => resolve(JSON.parse(data)));
    }).on('error', reject);
  });
}

async function run() {
  await new Promise(r => setTimeout(r, 2000));
  const pages = await getJson('http://127.0.0.1:9222/json');
  const wsUrl = pages[0].webSocketDebuggerUrl;
  console.log('WS URL:', wsUrl);

  const ws = new WebSocket(wsUrl);
  let id = 1;
  const pending = new Map();

  ws.onmessage = (event) => {
    const msg = JSON.parse(event.data);
    if (msg.id && pending.has(msg.id)) {
      pending.get(msg.id)(msg);
      pending.delete(msg.id);
    }
  };

  const send = (method, params = {}) => {
    return new Promise((resolve) => {
      const msgId = id++;
      pending.set(msgId, resolve);
      ws.send(JSON.stringify({ id: msgId, method, params }));
    });
  };

  await new Promise(r => ws.onopen = r);
  console.log('WebSocket connected');

  await send('Page.enable');
  await send('Page.navigate', { url: 'http://127.0.0.1:8089' });
  await new Promise(r => setTimeout(r, 2500));

  // Open invitation and reveal section-mempelai
  const evalRes = await send('Runtime.evaluate', {
    expression: `
      (() => {
        const btn = document.querySelector('[data-buka-undangan]');
        if (btn) btn.click();
        document.body.classList.add('invitation-opened');
        document.body.classList.remove('overflow-hidden');
        const sM = document.getElementById('section-mempelai');
        if (sM) sM.classList.add('section-revealed');
        
        // scroll to section-ayat
        const sA = document.getElementById('section-ayat');
        if (sA) sA.scrollIntoView({ behavior: 'instant', block: 'start' });

        return {
          windowScrollY: window.scrollY,
          sectionAyat: sA ? sA.getBoundingClientRect() : null,
          sectionMempelai: sM ? sM.getBoundingClientRect() : null,
          leafContainer: document.querySelector('.ornament-leaf-left') ? document.querySelector('.ornament-leaf-left').parentElement.getBoundingClientRect() : null,
          leafLeft: document.querySelector('.ornament-leaf-left') ? document.querySelector('.ornament-leaf-left').getBoundingClientRect() : null,
          leafRight: document.querySelector('.ornament-leaf-right') ? document.querySelector('.ornament-leaf-right').getBoundingClientRect() : null,
          surahText: document.querySelector('#section-ayat .gold-divider') ? document.querySelector('#section-ayat .gold-divider').previousElementSibling.getBoundingClientRect() : null,
          goldDivider: document.querySelector('#section-ayat .gold-divider') ? document.querySelector('#section-ayat .gold-divider').getBoundingClientRect() : null,
          mempelaiTag: document.querySelector('.mempelai-tag') ? document.querySelector('.mempelai-tag').getBoundingClientRect() : null,
          mempelaiTitle: document.querySelector('.mempelai-title') ? document.querySelector('.mempelai-title').getBoundingClientRect() : null,
        };
      })()
    `,
    returnByValue: true
  });

  console.log('DOM Measurements:', JSON.stringify(evalRes.result.value, null, 2));

  // Take screenshot
  const shot = await send('Page.captureScreenshot', { format: 'png' });
  fs.writeFileSync('scratch/measured_view.png', Buffer.from(shot.result.data, 'base64'));
  console.log('Screenshot saved to scratch/measured_view.png');

  edge.kill();
  process.exit(0);
}

run().catch(err => {
  console.error(err);
  edge.kill();
  process.exit(1);
});
