const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const ffmpegPath = require('@ffmpeg-installer/ffmpeg').path;
const dir = 'clients reviews';

const files = fs.readdirSync(dir).filter(f => f.endsWith('.mp4'));

files.forEach(file => {
    const inputPath = path.join(dir, file);
    const backupPath = path.join(dir, `original_${file}`);
    const tempPath = path.join(dir, `temp_${file}`);
    
    // Skip if already processed or is a backup
    if (file.startsWith('original_') || file.startsWith('temp_')) return;
    
    console.log(`Processing ${file}...`);
    
    try {
        // Compress the video
        // -vf "scale=-2:720" resizes the video to 720p height, keeping aspect ratio
        // -crf 28 is a good balance between compression and quality
        // -preset fast speeds up encoding
        execSync(`"${ffmpegPath}" -i "${inputPath}" -vcodec libx264 -crf 28 -preset fast -vf "scale=-2:720" -acodec aac -b:a 128k -y "${tempPath}"`, { stdio: 'inherit' });
        
        // Backup original
        fs.renameSync(inputPath, backupPath);
        
        // Replace with compressed
        fs.renameSync(tempPath, inputPath);
        
        console.log(`Successfully compressed ${file}`);
    } catch (err) {
        console.error(`Failed to compress ${file}:`, err.message);
    }
});
