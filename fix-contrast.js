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

const replacements = [
    { regex: /#c2410c/gi, replacement: '#c2410c' },
    { regex: /#9a3412/gi, replacement: '#9a3412' },
    { regex: /#c2410c/gi, replacement: '#c2410c' },
    { regex: /#c2410c/gi, replacement: '#c2410c' },
    { regex: /#c2410c/gi, replacement: '#c2410c' },
    { regex: /#c2410c/gi, replacement: '#c2410c' },
    { regex: /text-orange-700/g, replacement: 'text-orange-700' },
    { regex: /bg-orange-700/g, replacement: 'bg-orange-700' },
    { regex: /text-orange-700/g, replacement: 'text-orange-700' },
    { regex: /bg-orange-700/g, replacement: 'bg-orange-700' },
    { regex: /hover:bg-orange-700/g, replacement: 'hover:bg-orange-700' },
    { regex: /hover:text-orange-700/g, replacement: 'hover:text-orange-700' }
];

walkDir('.', (filePath) => {
    if (filePath.endsWith('.html') || filePath.endsWith('.css') || filePath.endsWith('.js')) {
        let content = fs.readFileSync(filePath, 'utf8');
        let newContent = content;
        
        replacements.forEach(r => {
            newContent = newContent.replace(r.regex, r.replacement);
        });
        
        if (content !== newContent) {
            fs.writeFileSync(filePath, newContent, 'utf8');
            console.log('Updated ' + filePath);
        }
    }
});
