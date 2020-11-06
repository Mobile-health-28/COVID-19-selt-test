//Install express server
const express = require('express');

const app = express();

// Serve only the static files form the dist directory
app.use(express.static('./dist/covid19'));

app.get('/*', function(req, res) {
  res.sendFile('index.html', {root: 'dist/covid19/'}
);
});

// Start the app by listening on the default Heroku port
app.listen(process.env.PORT || 4200);
