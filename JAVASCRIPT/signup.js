const express = require('express');
const bodyParser = require('body-parser');
const Excel = require('exceljs');

const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));  // Serve static files like HTML

// POST route for handling signup
app.post('/submit-signup', async (req, res) => {
    const { email, username, password, confirmPassword } = req.body;

    // Check if passwords match
    if (password !== confirmPassword) {
        return res.status(400).send('Passwords do not match');
    }

    // Load or create a new workbook
    const workbook = new Excel.Workbook();
    let worksheet;
    try {
        await workbook.xlsx.readFile('./UserData.xlsx');
        worksheet = workbook.getWorksheet('UserData');
    } catch (err) {
        // If the workbook does not exist, create it
        worksheet = workbook.addWorksheet('UserData');
        worksheet.columns = [
            { header: 'Email', key: 'email', width: 30 },
            { header: 'Username', key: 'username', width: 30 },
            { header: 'Password', key: 'password', width: 30 }
        ];
    }

    // Add a row to the worksheet
    worksheet.addRow({ email, username, password }).commit();

    // Save the workbook
    await workbook.xlsx.writeFile('./UserData.xlsx');

    res.send('Signup successful!');
});

// Start server
app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
