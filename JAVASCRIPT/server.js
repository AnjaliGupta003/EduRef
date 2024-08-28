const express = require('express');
const bodyParser = require('body-parser');
const path = require('path');
const XLSX = require('xlsx');
const fs = require('fs');
const session = require('express-session');

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));

// Set up session management
app.use(session({
    secret: 'your-secret-key',
    resave: false,
    saveUninitialized: true,
    cookie: { secure: false } // Set to true if using HTTPS
}));

// Serve the login page
app.get('/login', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'login.html'));
});

// Handle login form submission
app.post('/submit-login', (req, res) => {
    const { username, password } = req.body;

    // Log the login attempt
    logLoginAttempt(username, password);

    // Simple authentication logic (replace with your own logic)
    if (username === 'user' && password === 'password') {
        req.session.user = username;
        res.redirect('/');
    } else {
        res.send('Invalid username or password');
    }
});

app.get('/', (req, res) => {
    const isLoggedIn = req.session.user ? true : false;
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

function logLoginAttempt(username, password) {
    const filePath = path.join(__dirname, 'login_attempts.xlsx');

    let workbook;
    let worksheet;

    // Check if the file exists
    if (fs.existsSync(filePath)) {
        workbook = XLSX.readFile(filePath);
        worksheet = workbook.Sheets['LoginAttempts'];
    } else {
        workbook = XLSX.utils.book_new();
        worksheet = XLSX.utils.aoa_to_sheet([['Username', 'Password', 'Timestamp']]);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'LoginAttempts');
    }

    const newRow = [username, password, new Date().toLocaleString()];
    XLSX.utils.sheet_add_aoa(worksheet, [newRow], { origin: -1 });

    workbook.Sheets['LoginAttempts'] = worksheet;
    XLSX.writeFile(workbook, filePath);
}

app.listen(port, () => {
    console.log(`Server is running at http://localhost:${port}`);
});
