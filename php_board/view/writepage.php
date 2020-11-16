<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/writepage.css">
    <title>WritePage</title>
</head>

<body>
    <button onclick="history.back()">Back</button>
    <div id="board_write">
        <h1><a href="/">Free Board</a></h1>
        <h4>space for writing.</h4>
        <div id="write_area">
            <form action="../controller/write.php" method="post">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="Title" maxlength="100" required></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="Content" required></textarea>
                </div>
                <div class="bt_se">
                    <button type="submit">Writing</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>