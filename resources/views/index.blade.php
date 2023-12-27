<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<script>
    let url = "https://api.anthropic.com/v1/complete";
    let token = "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"
    let headers = {
        "accept": "application/json",
        "anthropic-version": "2023-06-01",
        "content-type": "application/json",
        "x-api-key": token
    };
    let data = {
        "model": "claude-2",
        "prompt": "\n\nHuman: Жашоонун маңызы эмне!\n\nAssistant:",
        "max_tokens_to_sample": 512,
        "stream": true
    }
    fetch(url, {
        method: "POST",
        headers: headers,
        body: data
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // или response.text(), response.blob(), и т. д.
        })
        .then(data => {
            // Обработка данных, полученных от сервера
            console.log(data);
        })
        .catch(error => {
            // Обработка ошибок
            console.error('There was a problem with the fetch operation:', error);
        });
</script>
</body>
</html>
