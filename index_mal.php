<?php
include('simple_html_dom.php');
$html = file_get_html('https://m.mangabat.com/manga-list-all?type=topview');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    </script>
    <style>
        body {
            margin: 0 px;
            background-color: black;
        }

        .card {
            margin: 0 auto;
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
        }

        .card-body>img {
            max-height: 40%;
            max-width: 40%;
        }

        #active-page {
            font-weight: bold;
        }

        .card-text {
            /* background-color: rgba(245, 245, 245, 1); */
            /* opacity: .4; */
            color: white;
        }
        .numbering{
            color: white;
        }
        .card-img{
            float: none;
        }
        /* .manga-table{
            float: left;
            text-align: center;
        }
        .card-title{
            float: right;
            text-align: left;
        }
        tr td th{
            border: none;
        } */
    </style>
</head>

<body>
    <!--NavBar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="navbar-brand" href="index.php" id="active-page">Home</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="#">Genre</a>
                </li>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown" id="secret">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="account/login.php">Login</a>
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="account/register.php">Register</a>
                </div>
            </li>
        </ul>
        </div>
    </nav>

    <!-- tabel untuk data komik -->
    <div style="margin: 5em;">
        <table class="table table-striped" style="border-bottom-style: none;">
            <thead>
                <tr style="background-color: cyan; text-align: center;">
                    <th scope="col" style="width: 100px;">#</th>
                    <th scope="col">Title</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($html->find('a.item-img') as $element) {
                ?>
                    <tr>
                        <th class="numbering" scope="row" style="text-align: center;"><?php echo $count; ?></th>
                        <td class="manga-table">
                            <div class="card-transparent" style="max-width: 540px;opacity: 0px; margin: 0 auto;">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <a class="card-block stretched-link text-decoration-none" style="margin: 0 auto;" href="manga.php?manga=<?php echo $element->href; ?>">
                                            <img src="<?php echo $element->children(0)->src; ?>" class="card-img" style="width: 150px; float: left;">
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                        <a class="card-block stretched-link text-decoration-none" style="margin: 0 auto;" href="manga.php?manga=<?php echo $element->href; ?>">
                                            <h5 class="card-title"><?php echo $element->title; ?></h5>
                                        </a>
                                            <p class="card-text"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>