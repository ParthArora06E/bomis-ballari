const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        const dirPath = path.join(dir, f);
        if (f === 'node_modules' || f === '.git') return;
        const isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(dirPath);
    });
}

walkDir('.', (filePath) => {
    if (filePath.endsWith('.html')) {
        let content = fs.readFileSync(filePath, 'utf8');
        const regex = /<!-- Meta Pixel Code -->[\s\S]*?<!-- End Meta Pixel Code -->\s*/g;
        
        if (regex.test(content)) {
            const newContent = content.replace(regex, '');
            fs.writeFileSync(filePath, newContent, 'utf8');
            console.log('Removed pixel from ' + filePath);
        }
    }
});
