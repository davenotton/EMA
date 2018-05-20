<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>
    <!-- Navigation menu. -->
    <nav id="main-menu">
        <ul id="menu-list">
            <li id="logo">
                <span><img src="img/Logo.png" id="ou"></span>
                <h1 id="walking-club">Walking Club</h1><span></span>
            </li>
            <li>
                <a href="" style="text-decoration: none;">Walk events</a>
            </li>
            <li>
                <a href="" style="text-decoration: none">Members</a>
            </li>
            <li>
                <a href="" style="text-decoration: none;">Mail</a>
            </li>
            <li>
                <a href="" style="text-decoration: none;">News</a>
            </li>
            <li>
                <a href="" style="text-decoration: none;">Log out</a>
            </li>
        </ul>
    </nav>

    <!-- Search bar. -->
    <div id="search-div">
      <form action="query.php" method="post">
        <label id="search-label">Search Walks:</label><input name="search-term" type="search" id="search-input" placeholder="Search...">
        <button id="submit-button" onclick="send()">Search</button>
        <p class="info">Enter a posative or negative number to search and display walks. </p>
        <p class="info">Eg. 2 will display walks two days in the future from the current date. </p>
        <p class="info">Eg. -2 will display walks that took place two days prevoius to the current date.</p>
      </form>
    </div>
