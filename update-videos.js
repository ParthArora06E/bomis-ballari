const fs = require('fs');

function updateFile(file) {
    if (!fs.existsSync(file)) return;
    let content = fs.readFileSync(file, 'utf8');

    // Replace preload="metadata" with preload="none" for all video tags
    content = content.replace(/preload="metadata"/g, 'preload="none"');

    if (file.endsWith('index.html')) {
        const oldJS = `      // Testimonial Reel Autoplay
      const reel = document.getElementById('testimonial-reel');
      if (reel) {
        let index = 0;
        const items = reel.querySelectorAll('.reel-item');
        const count = items.length;

        const autoPlayReel = () => {
          index = (index + 1) % count;
          reel.scrollTo({
            top: index * reel.offsetHeight,
            behavior: 'smooth'
          });
          
          // Play current video
          items.forEach((item, i) => {
            const vid = item.querySelector('video');
            if (i === index) vid.play();
            else vid.pause();
          });
        };

        let interval = setInterval(autoPlayReel, 5000);

        reel.addEventListener('mouseenter', () => clearInterval(interval));
        reel.addEventListener('mouseleave', () => interval = setInterval(autoPlayReel, 5000));
        
        // Initial play
        const firstVid = items[0].querySelector('video');
        if (firstVid) firstVid.play();
      }`;

        const newJS = `      // Testimonial Reel Autoplay
      const reel = document.getElementById('testimonial-reel');
      if (reel) {
        let index = 0;
        const items = reel.querySelectorAll('.reel-item');
        const count = items.length;
        let interval;

        const autoPlayReel = () => {
          index = (index + 1) % count;
          reel.scrollTo({
            top: index * reel.offsetHeight,
            behavior: 'smooth'
          });
          
          // Play current video
          items.forEach((item, i) => {
            const vid = item.querySelector('video');
            if (i === index) vid.play();
            else vid.pause();
          });
        };

        const reelObserver = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              // Start auto-play when visible
              const firstVid = items[0].querySelector('video');
              if (firstVid && firstVid.paused) firstVid.play();
              if (!interval) interval = setInterval(autoPlayReel, 5000);
            } else {
              // Pause when out of view
              items.forEach(item => {
                const vid = item.querySelector('video');
                vid.pause();
              });
              if (interval) {
                clearInterval(interval);
                interval = null;
              }
            }
          });
        }, { threshold: 0.1 });

        reelObserver.observe(reel);

        reel.addEventListener('mouseenter', () => {
            if (interval) {
                clearInterval(interval);
                interval = null;
            }
        });
        reel.addEventListener('mouseleave', () => {
            if (!interval) interval = setInterval(autoPlayReel, 5000);
        });
      }`;
        content = content.replace(oldJS, newJS);
    }
    
    fs.writeFileSync(file, content, 'utf8');
    console.log('Updated ' + file);
}

updateFile('index.html');
updateFile('testimonials.html');
