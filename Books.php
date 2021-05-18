<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Blake Drost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title> McNeese Bookstore Home Page </title>
        <style>
            #HeaderItems{
                padding-right: 5px;
                padding-left: 5px;
                padding-top: 20px;
                padding-bottom: 20px;
                height: 120px;
                width:99%;
                border: blue;
                border-style: solid;
                border-width: thick;
            }
            .HeaderItem{
                display: inline-block;
                overflow:visible;
            }
            #HomePageLinkContainer{
                padding-left: 2.5%;
                padding-right: 2.5%;
                width:23%;
            }
            #SearchBarContainer{
                padding-left: 2.5%;
                padding-right: 2.5%;
                width:38%;
                height:100%;
            }
            #SearchBar{
                padding-left: 2.5%;
                padding-right: 2.5%;
                height:25%;
                width:70%;
            }
            #SearchButton{
                padding-left: 2.5%;
                padding-right: 2.5%;
                height:25%;
                width:20%;
            }
            #CartContainer{
                align-items: center;
                padding-left: 2.5%;
                padding-right: 2.5%;
                width:7%;
                height:auto;
            }
            #LoginContainer{
                padding-left: 2.5%;
                padding-right: 2.5%;
                width:10%;
            }
            #LoginLink{                
                width:auto;
            }
            .HeaderPicture{
                vertical-align: middle;
                width: 100%;
                height:100%;
                max-height: 120px;
            }
            #FooterContainer{
                padding-top: 20px;
                padding-bottom: 20px;
                height: 120px;
                width:100%;
            }
            .FooterItems{
                display: inline-block;
                align-items: center;
            }
            #LeftItem{
                padding-left: 2.5%;
                padding-right: 2.5%;
                width: 20%;
            }
            #MiddleItem{
                padding-left: 2.5%;
                padding-right: 2.5%;
                width: 40%;
            }
            #RightItem{
                padding-left: 2.5%;
                padding-right: 2.5%;
                width: 20%;
            }
            .fa{
                padding: 20px;
                font-size: 30px;
                text-align: center;
                text-decoration: none;
            }
            .fa:hover {
                opacity: 0.7;
            }
            .fa-facebook{
                background: #3B5998;
                color: white;
            }
            .fa-twitter{
                background: #55ACEE;
                color: white;
            }
            .mainDisplayContainer{
                display: inline;
            }
            .filterContainer{
                float: left;
                height: 100%;
                width: 18%;
                padding-right: 1%;
                padding-left: 1%;
            }
            .gridContainer{
                height: 100%;
                width: 70%;
                margin: 10px 0 0 0;
                overflow: hidden;
            }
            .gridItem{
                display: inline-block;
                text-align: left;
                vertical-align: middle;
                height: 250px;
                width: 250px;
                padding: auto;
            }
            #clear{
                clear: both;
            }
            .bookPic{
                height: 150px;
                width: 150px;
            }
        </style>
    </head>
    <?php
    echo '<body>
        <!--Header Section-->
        <div name="HeaderItems" id="HeaderItems">
            <div name="HomePageLinkContainer" id="HomePageLinkContainer" class="HeaderItem">
                <a name="HomePageLink" id="HomeLink" href="Home.html">
                    <img src="McNeeseBookstore.png" class="HeaderPicture">
                </a>
            </div>
            <div name="SearchBarContainer" id="SearchBarContainer" class="HeaderItem">
                <form id="searchForm" onsubmit="window.location.reload() method="post>
                    <input type="text" name="SearchBar" id="SearchBar">
                    <input type="submit" name="searchSubmit" id="SearchButton" value="Search"/>
                </form>
            </div>
            <div name="CartContainer" id="CartContainer" class="HeaderItem">
                <a name="CartLink" id="CartLink" href="Checkout.html">
                    <img src="Cart.png" class="HeaderPicture">
                </a>
            </div>
            <div name="LoginContainer" id="LoginContainer" class="HeaderItem">
                <a name="LoginLink" id="LoginLink" href="Login.html">
                    <p style="font-size:20px;">Login</p>
                </a>
            </div>
        </div>
        <!--Body Section-->
        <div name="Main" id="Main" class="mainDisplayContainer">
            <div name="Filters" id="Filters" class="filterContainer">
                <form onsubmit="window.location.reload()" method="post" id="filterForm">
                    <p><b>Filters</b></p><hr>
                    <ul><b>Subject</b><br>
                        <input type="checkbox" name="sub[]" id="sub_math" value="MATH">MATH<br>
                        <input type="checkbox" name="sub[]" id="sub_csci" value="CSCI">CSCI<br>
                        <input type="checkbox" name="sub[]" id="sub_engr" value="ENGR">ENGR<br>
                        <input type="checkbox" name="sub[]" id="sub_hist" value="HIST">HIST<br>
                        <input type="checkbox" name="sub[]" id="sub_engl" value="ENGL">ENGL<br>
                        <input type="checkbox" name="sub[]" id="sub_chem" value="CHEM">CHEM<br>
                    </ul><hr>
                    <ul><b>Price</b><br>
                        <input type="checkbox" name="price[]" id="price0-50" value="0 50">under 50$<br>
                        <input type="checkbox" name="price[]" id="price50-100" value="50 100">50$ - 100$<br>
                        <input type="checkbox" name="price[]" id="price100" value="100 999">over 100$<br>
                    </ul><hr>
                    <ul><b>InStock</b><br>
                        <input type="checkbox" name="instock" id="instock" value="0">In Stock<br>
                    </ul><hr>
                    <input type="submit" name="filterSubmit" value = "Apply Filter"/>
                </form>
            </div>';
            echo '<div name="Display" id="Display" class="gridContainer">';
            
                $servername = "localhost";
                $username = "root";
                $password = "";

                $dbname = "msubookstore";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if($_POST['searchSubmit']){
                    $sql = "SELECT DISTINCT *
                    FROM Book
                    INNER JOIN CourseToBookBrdg
                    ON Book.pk_ISBN = CourseToBookBrdg.ISBN
                    WHERE ";
                }

                if($_POST['filterSubmit']){
                    //make some call to aggrigate all the filters being applied
                    $stringAccumulator = "";
                    $sub;
                    $price;
                    $instock;
                    //checking if no filter boxes where selected
                    if(!isset($_POST['sub']) and !isset($_POST['price']) and !isset($_POST['instock'])){
                        $sql = "SELECT DISTINCT book_title, book_author, pk_ISBN, book_price, img_file_path, qty_in_stock
                    FROM Book
                    INNER JOIN CourseToBookBrdg
                    ON Book.pk_ISBN = CourseToBookBrdg.ISBN";
                    $result = $conn->query($sql);

                    $index = 0;
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div id='item$index' class='gridItem'>"."<img class='bookPic' src='".$row["img_file_path"]."'><br>";
                        echo "<b>Title:</b> ".$row["book_title"]."<br>";
                        echo "<b>Author:</b> ".$row["book_author"]."<br>";
                        echo "<b>ISBN:</b> ".$row["pk_ISBN"]."<br>";
                        echo "<b>Price:</b> ".$row["book_price"]."<br></div>";
                        $index = $index + 1;
                    }
                    return;
                    }
                    //declare the variables that exist
                    //concatentating subjects to where statement
                    if(isset($_POST['sub'])){
                        $stringAccumulator .= "(fk_subject = ";
                        $sub = $_POST['sub'];
                        if(sizeof($sub)==1){
                            $stringAccumulator .= "'" . $sub[0] . "'";
                        }
                        if(sizeof($sub)>1){
                            $stringAccumulator .= "'" . $sub[0] . "'";
                            for($i = 1; $i < sizeof($sub); $i++){
                                $stringAccumulator .= " OR fk_subject = '" . $sub[$i] . "' ";
                            }
                        }
                        $stringAccumulator .= ")";
                    }
                    //concatentating prices to where statement
                    if(isset($_POST['price'])){
                        if(isset($_POST['sub'])){
                            $stringAccumulator .= " AND ";
                        }
                        $stringAccumulator .= "(";
                        $price = $_POST['price'];
                        if(sizeof($price)==1){
                            $pieces = explode(" ", $price[0]);
                            $stringAccumulator .= "(book_price >= '" . $pieces[0] . "' AND book_price <= '" . $pieces[1] . "')";
                        }
                        if(sizeof($price)>1){
                            $pieces = explode(" ", $price[0]);
                            $stringAccumulator .= "(book_price >= '" . $pieces[0] . "' AND book_price <= '" . $pieces[1] . "') ";
                            for($i = 1; $i < sizeof($price); $i++){
                                $pieces = explode(" ", $price[$i]);
                                $stringAccumulator .= " OR (book_price >= '" . $pieces[0] . "' AND book_price <= '" . $pieces[1] . "') ";
                            }
                        }
                        $stringAccumulator .= ")";
                    }
                    //concatentating instock to where statement
                    if(isset($_POST['instock'])){
                        if(isset($_POST['sub']) or isset($_POST['price'])){
                            $stringAccumulator .= " AND ";
                        }
                        $stringAccumulator .= "(qty_in_stock > ";
                        $instock = $_POST['instock']; 
                        $stringAccumulator .= "'0')";
                    }
                    

                    
                    $sql = "SELECT DISTINCT book_title, book_author, pk_ISBN, book_price, img_file_path, qty_in_stock
                    FROM Book
                    INNER JOIN CourseToBookBrdg
                    ON Book.pk_ISBN = CourseToBookBrdg.ISBN
                    WHERE ". $stringAccumulator;
                    $result = $conn->query($sql);

                    $index = 0;
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div id='item$index' class='gridItem'>"."<img class='bookPic' src='".$row["img_file_path"]."'><br>";
                        echo "<b>Title:</b> ".$row["book_title"]."<br>";
                        echo "<b>Author:</b> ".$row["book_author"]."<br>";
                        echo "<b>ISBN:</b> ".$row["pk_ISBN"]."<br>";
                        echo "<b>Price:</b> ".$row["book_price"]."<br></div>";
                        $index = $index + 1;
                    }
                }else{
                    $sql = "SELECT DISTINCT book_title, book_author, pk_ISBN, book_price, img_file_path
                    FROM Book
                    INNER JOIN CourseToBookBrdg
                    ON Book.pk_ISBN = CourseToBookBrdg.ISBN";
                    $result = $conn->query($sql);

                    $index = 0;
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div id='item$index' class='gridItem'>"."<img class='bookPic' src='".$row["img_file_path"]."'><br>";
                        echo "<b>Title:</b> ".$row["book_title"]."<br>";
                        echo "<b>Author:</b> ".$row["book_author"]."<br>";
                        echo "<b>ISBN:</b> ".$row["pk_ISBN"]."<br>";
                        echo "<b>Price:</b> ".$row["book_price"]."<br></div>";
                        $index = $index + 1;
                    }
                }

                $conn->close();
            echo '</div>';
        echo '</div>';
    echo '</body>';
    ?>
    <br>
    <footer name="FooterContainer" id="FooterContainer">
        <div name="LeftItem" id="LeftItem" class="FooterItems">
            <a name="McneeseSite" id="McneeseSite" href="https://www.mcneese.edu/">
                <img src="McNeeseUniversity.png">
            </a>
        </div>
        <div name="MiddleItem" id="MiddleItem" class="FooterItems">
            <b>PlaceHolder</b>
        </div>
        <div name="RightItem" id="RightItem" class="FooterItems">
            <div class="icon-container">
                <a href="https://www.facebook.com/McNeeseStateU" class="fa fa-facebook"></a>
                <a href="https://twitter.com/McNeese" class="fa fa-twitter"></a>
            </div>
        </div>
    </footer>
</html>