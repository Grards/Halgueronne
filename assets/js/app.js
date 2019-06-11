var $ = require('jquery'); 

global.$ = global.jQuery = $;

require('popper.js');
 
// On utilise ce chemin pour aller chercher le min.js car bootstrap est installé via npm, dans les node_modules et non copié manuellement dans les assets.
require('../../node_modules/bootstrap/dist/js/bootstrap.min.js');