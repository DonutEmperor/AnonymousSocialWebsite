import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'particles.js/particles';
const particlesJS = window.particlesJS;
/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load('particles-js', 'js/particlejs-config.json', function() {
    console.log('callback - particles.js config loaded');
  });