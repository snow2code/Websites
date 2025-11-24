<html lang="english">
<head>
    <title>{$title} | DCDoomVR's Website</title>
    <!-- Icons -->
    <link rel="icon" href="./favico.ico" type="image/x-icon">
    <link rel="shortcut icon" href="./favico.ico" type="image/x-icon">

    <!-- Styles -->
    {* <link href="css/sbpp.css" rel="stylesheet" type="text/css" /> *}
    <link href="css/snow2code.css" rel="stylesheet" type="text/css"/>

    <!-- Scripts -->
    {if $page == "test"}
    <script>
        function testing_systemmessage()
        {
            /* PHP
            $url = "https://raw.githubusercontent.com/Snow2Code/dcdoomvr.infy.uk/refs/heads/main/system-message/active";

            // Fetch the file content
            $fileContent = file_get_contents($url);

            if ($fileContent === false) {
                console.log("Failed to fetch the file.");
            } else {
                // echo "File content:";
                if ($fileContent === "true\n") {
                    console.log("true");
                } else {
                    console.log("bad value");
                }
            }
            */
           
            const url = `https://api.github.com/repos/snow2code/dcdoomvr.infy.uk/contents/system-message/active/?ref=main`;
        
            fetch(url, {
                headers: {
                    Accept: 'application/vnd.github.v3.raw', // Ensures raw file content is returned
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Error fetching file: ", response.statusText);
                    }
                    return response.text(); // For text-based files
                })
                .then((data) => {
                    console.log('File contents:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    </script>
    {/if}
</head>
<body>