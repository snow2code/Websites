const express = require('express');
const fs = require('fs');
const path = require('path');
const app = express();
const PORT = 8008; // hehe boobs :3

// Serve static files from the public directory
app.use(express.static("./"));

app.get('/pages/', (req, res) => {
    console.log(__dirname);
    const directoryPath = path.join(__dirname, 'public', req.path);

    if (fs.existsSync(directoryPath) && fs.lstatSync(directoryPath).isDirectory()) {
        fs.readdir(directoryPath, (err, files) => {
            if (err) {
                res.status(500).send('Error reading directory.');
                return;
            }
            let title = path.resolve(directoryPath);
            title = title.slice(58)
            console.log(title);
            let fileList = `<h1>Directory Listing of ${title}</h1><ul>`;
            files.forEach(file => {
                const filePath = path.join(req.path, file);
                fileList += `<li><a href="${filePath}">${file}</a></li>`;
            });
            fileList += `</ul>`;
            
            res.send(fileList);
        });
    }
});

app.use('/images', express.static(path.join(__dirname, 'assets')));

// Catch-all route for handling 404 errors
app.use((req, res, next) => {
    res.status(404).sendFile(__dirname + '/404.html');
});

app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
