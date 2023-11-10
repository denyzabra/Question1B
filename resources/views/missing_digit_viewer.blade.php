<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missing Digit Viewer</title>
</head>
<body>
    <h1>Missing Digit Viewer</h1>
    <p id="result">Result will be displayed here.</p>

    <script>
        // Make an AJAX request to your missing-digit-viewer endpoint
        fetch('/missing-digit-viewer')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();  // Use json() to parse JSON directly
            })
            .then(data => {
                // Use the data directly
                document.getElementById('result').innerText = `Missing Digit: ${data.missing_digit}`;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('result').innerText = 'Error: Unable to retrieve missing digit.';
            });
    </script>
</body>
</html>
