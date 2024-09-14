const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const bcrypt = require('bcrypt');
const cors = require('cors');



const app = express();
const saltRounds = 10;

app.use(cors());

// Database connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'soen287_demo',
    port: 3307
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connected to the MySQL server.');
});

app.use(bodyParser.json());

app.post('/create-account', (req, res) => {
    const { username, password, email } = req.body; // Include email in the destructuring

    // Check if user already exists
    db.query('SELECT * FROM usersc WHERE username = ? OR email = ?', [username, email], (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'An error occurred' });
            return;
        }

        if (result.length > 0) {
            return res.status(400).json({ success: false, message: 'Username or email already exists' });
        }

        // Password hashing
        bcrypt.hash(password, saltRounds, (err, hash) => {
            if (err) {
                return res.status(500).json({ success: false, message: 'Error hashing password' });
            }

            // Inserting user into the database
            db.query('INSERT INTO usersc (username, password, email) VALUES (?, ?, ?)', [username, hash, email], (err, result) => {
                if (err) {
                    return res.status(500).json({ success: false, message: 'Error registering user' });
                }
                res.json({ success: true, message: 'User registered successfully' });
            });
        });
    });
});


app.post('/login', (req, res) => {
    const { username, password } = req.body;

    // Query database for the user
    db.query('SELECT * FROM usersc WHERE username = ?', [username], (err, users) => {
        if (err) {
            res.status(500).json({ success: false, message: 'An error occurred' });
            return;
        }

        if (users.length === 0) {
            res.status(401).json({ success: false, message: 'Invalid username or password' });
            return;
        }

        const user = users[0];

        // Compare hashed password
        bcrypt.compare(password, user.password, (err, isMatch) => {
            if (err) {
                res.status(500).json({ success: false, message: 'An error occurred' });
                return;
            }

            if (isMatch) {
                // Passwords match
                res.json({ success: true, message: 'Logged in successfully' });
            } else {
                // Passwords don't match
                res.status(401).json({ success: false, message: 'Invalid username or password' });
            }
        });
    });
});

app.post('/create-provider-account', (req, res) => {
    const { username, password, email } = req.body;

    // Check if provider already exists
    db.query('SELECT * FROM usersp WHERE username = ? OR email = ?', [username, email], (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'An error occurred' });
            return;
        }

        if (result.length > 0) {
            return res.status(400).json({ success: false, message: 'Username or email already exists' });
        }

        // Password hashing
        bcrypt.hash(password, saltRounds, (err, hash) => {
            if (err) {
                return res.status(500).json({ success: false, message: 'Error hashing password' });
            }

            // Inserting provider into the database
            db.query('INSERT INTO usersp (username, password, email) VALUES (?, ?, ?)', [username, hash, email], (err, result) => {
                if (err) {
                    return res.status(500).json({ success: false, message: 'Error registering provider' });
                }
                res.json({ success: true, message: 'Provider account created successfully' });
            });
        });
    });
});

app.post('/provider-login', (req, res) => {
    const { username, password } = req.body;

    // Query database for the provider
    db.query('SELECT * FROM usersp WHERE username = ?', [username], (err, providers) => {
        if (err) {
            res.status(500).json({ success: false, message: 'An error occurred' });
            return;
        }

        if (providers.length === 0) {
            res.status(401).json({ success: false, message: 'Invalid username or password' });
            return;
        }

        const provider = providers[0];

        // Compare hashed password
        bcrypt.compare(password, provider.password, (err, isMatch) => {
            if (err) {
                res.status(500).json({ success: false, message: 'An error occurred' });
                return;
            }

            if (isMatch) {
                // Passwords match
                res.json({ success: true, message: 'Logged in successfully' });
            } else {
                // Passwords don't match
                res.status(401).json({ success: false, message: 'Invalid username or password' });
            }
        });
    });
});

app.post('/update-account', (req, res) => {
    const { editType, currentUsername, newUsername, newEmail, currentPassword, newPassword } = req.body;

    // Check if user exists
    db.query('SELECT * FROM usersc WHERE username = ?', [currentUsername], (err, users) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'An error occurred' });
        }
        if (users.length === 0) {
            return res.status(401).json({ success: false, message: 'User not found' });
        }

        // Check current password
        bcrypt.compare(currentPassword, users[0].password, (err, isMatch) => {
            if (err) {
                return res.status(500).json({ success: false, message: 'Error verifying password' });
            }
            if (!isMatch) {
                return res.status(401).json({ success: false, message: 'Incorrect password' });
            }

            // Perform the appropriate update based on editType
            if (editType === 'username') {
                updateUsername(currentUsername, newUsername);
            } else if (editType === 'email') {
                updateEmail(currentUsername, newEmail);
            } else if (editType === 'password') {
                updatePassword(currentUsername, newPassword);
            } else {
                return res.status(400).json({ success: false, message: 'Invalid edit type' });
            }
        });
    });

    function updateUsername(username, newUsername) {
        db.query('UPDATE usersc SET username = ? WHERE username = ?', [newUsername, username], (err, result) => {
            if (err) {
                return res.status(500).json({ success: false, message: 'Error updating username' });
            }
            res.json({ success: true, message: 'Username updated successfully' });
        });
    }

    function updateEmail(username, newEmail) {
        db.query('UPDATE usersc SET email = ? WHERE username = ?', [newEmail, username], (err, result) => {
            if (err) {
                return res.status(500).json({ success: false, message: 'Error updating email' });
            }
            res.json({ success: true, message: 'Email updated successfully' });
        });
    }

    function updatePassword(username, newPassword) {
        bcrypt.hash(newPassword, saltRounds, (err, hash) => {
            if (err) {
                return res.status(500).json({ success: false, message: 'Error hashing new password' });
            }
            db.query('UPDATE usersc SET password = ? WHERE username = ?', [hash, username], (err, result) => {
                if (err) {
                    return res.status(500).json({ success: false, message: 'Error updating password' });
                }
                res.json({ success: true, message: 'Password updated successfully' });
            });
        });
    }
});

app.post('/delete-account', (req, res) => {
    const { username, password } = req.body;

    db.query('SELECT * FROM usersc WHERE username = ?', [username], (err, users) => {
        if (err) {
            return res.status(500).json({ success: false, message: 'An error occurred' });
        }
        if (users.length === 0) {
            return res.status(401).json({ success: false, message: 'User not found' });
        }

        // Check if the provided password matches
        bcrypt.compare(password, users[0].password, (err, isMatch) => {
            if (err || !isMatch) {
                return res.status(401).json({ success: false, message: 'Authentication failed' });
            }

            // Delete user from the database
            db.query('DELETE FROM usersc WHERE username = ?', [username], (err, result) => {
                if (err) {
                    return res.status(500).json({ success: false, message: 'Error deleting account' });
                }
                res.json({ success: true, message: 'Account deleted successfully' });
            });
        });
    });
});

app.post('/associate-license', (req, res) => {
    const { MembershipName, SerialNumber, PurchaseDate, ExpiryDate } = req.body;

    // SQL Query to insert data into the database
    const query = 'INSERT INTO licenses (MembershipName, SerialNumber, PurchaseDate, ExpiryDate) VALUES (?, ?, ?, ?)';

    db.query(query, [MembershipName, SerialNumber, PurchaseDate, ExpiryDate], (err, result) => {
        if (err) {
            console.error(err);
            res.status(500).json({ success: false, message: 'Error saving license data' });
        } else {
            res.json({ success: true, message: 'License data saved successfully' });
        }
    });
});

app.get('/get-memberships', (req, res) => {
    db.query('SELECT DISTINCT MembershipName FROM licenses', (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'Error fetching memberships' });
        } else {
            res.json({ success: true, data: result });
        }
    });
});

app.get('/get-membership-details/:name', (req, res) => {
    const membershipName = req.params.name;

    // Use DATE_FORMAT to format the dates
    db.query('SELECT SerialNumber, DATE_FORMAT(purchaseDate, "%Y-%m-%d") as purchaseDate, DATE_FORMAT(expiryDate, "%Y-%m-%d") as expiryDate FROM licenses WHERE MembershipName = ?', [membershipName], (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'Error fetching membership details' });
        } else {
            res.json({ success: true, data: result });
        }
    });
});

app.post('/renew-license-month', (req, res) => {
    const { serialNumber } = req.body;

    db.query('UPDATE licenses SET expiryDate = DATE_ADD(expiryDate, INTERVAL 1 MONTH) WHERE SerialNumber = ?', [serialNumber], (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'Error renewing license' });
        } else {
            res.json({ success: true, message: 'License renewed for 1 month' });
        }
    });
});

app.post('/renew-license-year', (req, res) => {
    const { serialNumber } = req.body;

    db.query('UPDATE licenses SET expiryDate = DATE_ADD(expiryDate, INTERVAL 1 YEAR) WHERE SerialNumber = ?', [serialNumber], (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'Error renewing license' });
        } else {
            res.json({ success: true, message: 'License renewed for 1 year' });
        }
    });
});

app.post('/cancel-license', (req, res) => {
    const { serialNumber } = req.body;

    db.query('DELETE FROM licenses WHERE SerialNumber = ?', [serialNumber], (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'Error canceling license' });
        } else {
            res.json({ success: true, message: 'License canceled successfully' });
        }
    });
});

app.get('/get-clients', (req, res) => {
    db.query('SELECT username FROM usersc', (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'Error fetching clients' });
        } else {
            res.json({ success: true, clients: result });
        }
    });
});

app.get('/get-client-details/:username', (req, res) => {
    const username = req.params.username;

    // Use DATE_FORMAT to format the reg_date in the format YYYY-MM-DD
    db.query('SELECT email, DATE_FORMAT(reg_date, "%Y-%m-%d") AS reg_date FROM usersc WHERE username = ?', [username], (err, result) => {
        if (err) {
            res.status(500).json({ success: false, message: 'Error fetching client details' });
        } else {
            // Check if the result is not empty
            if (result.length > 0) {
                res.json({ success: true, client: result[0] });
            } else {
                res.status(404).json({ success: false, message: 'Client not found' });
            }
        }
    });
});

app.post('/associate-client', (req, res) => {
    const { username, productName, SerialNumber } = req.body;

    // SQL Query to insert data into the database
    const query = 'INSERT INTO providerclients (username, productName, SerialNumber) VALUES (?, ?, ?)';

    db.query(query, [username, productName, SerialNumber], (err, result) => {
        if (err) {
            console.error(err);
            res.status(500).json({ success: false, message: 'Error saving data' });
        } else {
            res.json({ success: true, message: 'Data saved successfully' });
        }
    });
});

app.post('/block-serial', (req, res) => {
    const { serialNumber } = req.body;

    const query = 'DELETE FROM providerclients WHERE SerialNumber = ?';

    db.query(query, [serialNumber], (err, result) => {
        if (err) {
            console.error(err);
            res.status(500).json({ success: false, message: 'Error blocking serial number' });
        } else {
            res.json({ success: true, message: 'Serial number blocked and deleted successfully' });
        }
    });
});



app.listen(3000, () => {
    console.log('Server running on port 3000');
});



