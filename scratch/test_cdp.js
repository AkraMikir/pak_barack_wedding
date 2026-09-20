const http = require('http');
const { spawn } = require('child_process');

const edgePath = 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe';
const edge = spawn(edgePath, [
  '--headless',
  '--remote-debugging-port=9222',
  '--window-size=390,844',
  'http://127.0.0.1:8089'
]);

setTimeout(() => {
  http.get('http://127.0.0.1:9222/json', (res) => {
    let data = '';
    res.on('data', chunk => data += chunk);
    res.on('end', () => {
      console.log('Edge CDP endpoints:', JSON.parse(data).length);
      edge.kill();
    });
  }).on('error', (err) => {
    console.error('CDP error:', err.message);
    edge.kill();
  });
}, 2000);
