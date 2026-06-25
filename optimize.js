const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const images = [
    {
        file: 'logo/admission-poster-2026.webp',
        target: 'logo/admission-poster-2026.webp',
        resize: { width: 556 }, // 278 * 2 for retina
        options: { lossless: true } // Lossless webp to guarantee no quality loss
    },
    {
        file: 'logo/birla-logo-new.webp',
        target: 'logo/birla-logo-new.webp',
        resize: { width: 216 }, // 108 * 2
        options: { lossless: true }
    },
    {
        file: 'home contant/images/school-building.webp',
        target: 'home contant/images/school-building.webp',
        options: { quality: 90 } // High quality webp for JPG
    },
    {
        file: 'home contant/images/index_preprimary.webp',
        target: 'home contant/images/index_preprimary.webp',
        options: { quality: 90 }
    },
    {
        file: 'home contant/images/f2.webp',
        target: 'home contant/images/f2.webp',
        options: { quality: 90 }
    }
];

async function optimizeImages() {
    for (const img of images) {
        const inputPath = path.resolve(img.file);
        const outputPath = path.resolve(img.target);
        
        if (fs.existsSync(inputPath)) {
            let s = sharp(inputPath);
            if (img.resize) {
                s = s.resize(img.resize);
            }
            await s.webp(img.options).toFile(outputPath);
            console.log(`Optimized ${img.file} -> ${img.target}`);
        } else {
            console.log(`Not found: ${img.file}`);
        }
    }
}

optimizeImages().catch(console.error);
